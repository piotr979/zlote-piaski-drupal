<?php

namespace Drupal\custom_extras\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Footer' Block.
 *
 * @Block(
 *   id = "footer_block",
 *   admin_label = @Translation("Footer Block")
 * )
 */
class FooterBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    // Get the main menu links.
    $menu_tree = \Drupal::menuTree();
    $parameters = $menu_tree->getCurrentRouteMenuTreeParameters('main');
    $tree = $menu_tree->load('main', $parameters);
    $manipulators = [
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
    ];
    $tree = $menu_tree->transform($tree, $manipulators);

    $links = [];
    foreach ($tree as $item) {
      if (!$item->inActiveTrail) {
        $links[] = [
          '#type' => 'link',
          '#title' => $item->link->getTitle(),
          '#url' => $item->link->getUrlObject(),
        ];
      }
    }
    $phone_number = theme_get_setting('phone_number') ?: '0000';
    // Default value if null.
    $street_name = theme_get_setting('street_name') ?: 'Unknown Street';
    // Default value if null.
    $city_name = theme_get_setting('city_name') ?: 'Unknown City';
    // Default value if null.
    $zip_code = theme_get_setting('zip_code') ?: '00000';

    $address = $this->t('@street_name<br>@zip_code @city_name', [
      '@street_name' => $street_name,
      '@zip_code' => $zip_code,
      '@city_name' => $city_name,
    ]);

    return [
      '#theme' => 'footer_block',
      '#header1' => $this->t('O nas')->__toString(),
      '#text1' => $this->t('Nasz obiekt położony jest nad Morzem Bałtyckim i oferuje pokoje gościnne w atrakcyjnych cenach.')->__toString(),
      '#header2' => $this->t('Linki')->__toString(),
      '#links' => $links,
      '#header3' => $this->t('Dane kontaktowe')->__toString(),
      '#address' => $address,
      '#phone' => $phone_number,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
  }

}
