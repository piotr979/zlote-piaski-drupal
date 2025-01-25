<?php 

namespace Drupal\owl_slider\Plugin\Views\Style;

use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\Core\Template\Attribute;
use Drupal\views\ViewExecutable;

/**
 * A view style that renders Owl slides with text.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "owl_carousel_with_text",
 *   title = @Translation("Owl Carousel with text"),
 *   help = @Translation("Uses owl carousel and anime js"),
 *   theme = "owl_slider",
 *   display_types = {"normal"}
 * )
 */
class OwlStyle extends StylePluginBase {

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
    public function renderRows() {
        // Prepare an array of rows to be passed to the template
        $rows = [];
        
        foreach ($this->view->result as $row) {
            // Extracting the necessary fields from each row
            $image = $row->_entity->field_sl_image->view('default');
            $text = $row->_entity->field_sl_text->value;
    
            // Create an array for each row with the image and text
            $rows[] = [
                'field_sl_image' => $image,
                'field_sl_text' => $text,
            ];
            
        }
        // Render the template and pass the rows and other variables
        $template = [
            '#theme' => 'owl_slider',
            '#rows' => $rows,
            '#tofik' => '123', // Additional variable
        ];
    
        return \Drupal::service('renderer')->render($template);
    }
    
}
