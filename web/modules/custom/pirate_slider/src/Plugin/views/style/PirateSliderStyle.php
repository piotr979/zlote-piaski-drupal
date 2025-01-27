<?php 

namespace Drupal\pirate_slider\Plugin\Views\Style;

use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * A view style that renders slides with text.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "pirate_slider",
 *   title = @Translation("Pirate slider"),
 *   help = @Translation("Uses pirate slider to render animated slides"),
 *   theme = "pirate_slider",
 *   display_types = {"normal"}
 * )
 */
class PirateSliderStyle extends StylePluginBase {

    /**
     * Does this Style plugin allow Row plugins?
     *
     * @var bool
     */
    protected $usesRowPlugin = TRUE;

    /**
     * Does the Style plugin support grouping of rows?
     *
     * @var bool
     */
    protected $usesGrouping = FALSE;

    /**
     * Renders the rows of the view using the custom template.
     *
     * @return string
     */
    public function render() {
        // Attach the required libraries to the view.
        // We attach the libraries to the current render array.
        
        $this->view->element['#attached']['library'][] = 'pirate_slider/pirate-slider';
        $this->view->element['#attached']['library'][] = 'pirate_slider/animate-css';

        // You can proceed with rendering the rows as usual.
        return parent::render();
    }
}
