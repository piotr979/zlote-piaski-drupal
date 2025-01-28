<?php

namespace Drupal\custom_extras\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block that displays the current page title.
 *
 * @Block(
 *   id = "header_title_block",
 *   admin_label = @Translation("Header Title Block")
 * )
 */
class HeaderTitleBlock extends BlockBase implements ContainerFactoryPluginInterface {

/**
 * The route match service.
 *
 * @var \Drupal\Core\Routing\RouteMatchInterface
 */
protected RouteMatchInterface $routeMatch;

/**
 * Constructs a HeadTitleBlock object.
 */
public function __construct(array $configuration, $plugin_id, $plugin_definition, RouteMatchInterface $route_match) {
  parent::__construct($configuration, $plugin_id, $plugin_definition);
  $this->routeMatch = $route_match;
}

/**
 * {@inheritdoc}
 */
public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static(
    $configuration,
    $plugin_id,
    $plugin_definition,
    $container->get('current_route_match')
  );
}

public function build() {
  $request = \Drupal::requestStack()->getCurrentRequest();
  $route = $this->routeMatch->getRouteObject();

  $title = \Drupal::service('title_resolver')->getTitle($request, $route);

  if (is_array($title)) {
    // If title is an array, take the first element as the title (or handle it accordingly)
    $title = reset($title);
  }

  if (empty($title)) {
    $title = 'Home'; // Default title for the front page.
  }

  return [
    '#markup' => '<div class="header-title-block py-1 md:py-8 text-center text-white"><h3>' . htmlspecialchars($title) . '</h3></div>',
  ];
}

}
