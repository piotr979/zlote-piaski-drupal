<?php

namespace Drupal\custom_extras\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Google Map block.
 *
 * @Block(
 *   id = "google_map_block",
 *   admin_label = @Translation("Google Map Block"),
 * )
 */
class GoogleMapBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $config = $this->getConfiguration();

        // Use default URL if none is set.
        $iframe_url = !empty($config['iframe_url']) ? $config['iframe_url'] : 'https://www.google.com/maps/embed?...';

        return [
            '#markup' => '<div class="googlemap">
                <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19690.87739909004!2d16.32163647005269!3d54.38853226003663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fe2a7db9d21627%3A0xe3a0fe42bee228f2!2sPodkowa%20Le%C5%9Bna%2015%2C%2076-156%20Bobolin%2C%20Poland!5e0!3m2!1sen!2sie!4v1622024240282!5m2!1sen!2sie" width="1920" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>',
            '#allowed_tags' => ['div', 'iframe'], // Security: Allow only necessary tags.
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $config = $this->getConfiguration();

        $form['iframe_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Google Map Embed URL'),
            '#default_value' => isset($config['iframe_url']) ? $config['iframe_url'] : '',
            '#description' => $this->t('Enter the Google Maps iframe URL.'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->setConfigurationValue('iframe_url', $form_state->getValue('iframe_url'));
    }
}
