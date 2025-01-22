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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d558.528889392903!2d16.400974306313245!3d54.42624676948156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fe2bfe24f24b93%3A0x4f0098323e75b162!2sZ%C5%82ote+Piaski!5e0!3m2!1spl!2sus!4v1559893874579!5m2!1spl!2sus" width="1920" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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
