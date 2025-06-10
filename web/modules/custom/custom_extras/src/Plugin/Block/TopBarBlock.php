<?php

namespace Drupal\custom_extras\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Top Bar Block' Block.
 *
 * @Block(
 *   id = "top_bar_block",
 *   admin_label = @Translation("Top Bar Block"),
 * )
 */
class TopBarBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Get configuration.
    $config = $this->getConfiguration();
    // Build block content.
    return [
      '#markup' => '<div class="hidden md:block pb-2 my-1 text-white" ><div class="container hidden md:flex flex-row mx-auto text-xs">' .
      '<div class="flex flex-row"><p class="me-4">' . $this->t("Rezerwacje i pytania") . ': ' . $config['phone_number'] . '</p>' .
      '<p>ul. Podkowa leśna 15, 76 - 156 Bobolin</p></div></div></div>',

    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'phone_number' => $this->t('Tutaj number telefonu.'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['phone_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Numer telefonu'),
      '#default_value' => $this->configuration['phone_number'],
      '#description' => $this->t('Enter the phone number'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['phone_number'] = $form_state->getValue('phone_number');
  }

}
