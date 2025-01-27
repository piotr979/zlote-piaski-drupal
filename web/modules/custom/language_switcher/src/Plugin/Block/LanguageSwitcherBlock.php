<?php

namespace Drupal\language_switcher\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Path\PathMatcherInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\language\Plugin\Derivative\LanguageBlock as LanguageBlockDeriver;

/**
 * Provides a 'Language switcher' block.
 */
#[Block(
  id: "language_switcher block",
  admin_label: new TranslatableMarkup("Language switcher custom"),
  category: new TranslatableMarkup("Custom"),
  deriver: LanguageBlockDeriver::class
)]
class LanguageSwitcherBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * The path matcher.
   *
   * @var \Drupal\Core\Path\PathMatcherInterface
   */
  protected $pathMatcher;

  /**
   * Constructs a LanguageBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Core\Path\PathMatcherInterface $path_matcher
   *   The path matcher.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, LanguageManagerInterface $language_manager, PathMatcherInterface $path_matcher) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->languageManager = $language_manager;
    $this->pathMatcher = $path_matcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('language_manager'),
      $container->get('path.matcher')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    $access = $this->languageManager->isMultilingual() ? AccessResult::allowed() : AccessResult::forbidden();
    return $access->addCacheTags(['config:configurable_language_list']);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $type = $this->getDerivativeId();
    $route_match = \Drupal::routeMatch();
  
    // If there is no route match, for example when creating blocks on 404 pages
    // for logged-in users with big_pipe enabled using the front page instead.
    if ($this->pathMatcher->isFrontPage() || !$route_match->getRouteObject()) {
      // We are skipping the route match on both 404 and front page.
      $url = Url::fromRoute('<front>');
    }
    else {
      $url = Url::fromRouteMatch($route_match);
    }
  
    $links = $this->languageManager->getLanguageSwitchLinks($type, $url);
  
    if (isset($links->links)) {
        var_dump($links->link);exit;
      // Modify links to display language codes only (e.g., 'EN', 'PL', 'DE')
      $modified_links = [];
      foreach ($links->links as $lang => $link) {
        $language_code = strtoupper($lang); // Get the language code in uppercase (EN, PL, DE)
        $modified_links[$language_code] = $link;
      }
  
      // Build the block with modified links.
      $build = [
        '#theme' => 'links__language_block',
        '#links' => $modified_links,
        '#attributes' => [
          'class' => [
            "language-switcher-{$links->method_id}",
          ],
        ],
        '#set_active_class' => TRUE,
      ];
    }
  
    return $build;
  }
  

  /**
   * {@inheritdoc}
   *
   * @todo Make cacheable in https://www.drupal.org/node/2232375.
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
