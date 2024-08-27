<?php

namespace Drupal\bootstrap_views_cards\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render each item in a Bootstrap card.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "bootstrap_views_cards",
 *   title = @Translation("Bootstrap Cards"),
 *   help = @Translation("Displays rows in a Bootstrap Card Group layout"),
 *   theme = "bootstrap_views_cards",
 *   display_types = {"normal"}
 * )
 */
class BootstrapViewsCards extends StylePluginBase {
  /**
   * Does the style plugin for itself support to add fields to it's output.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Overrides \Drupal\views\Plugin\views\style\StylePluginBase::usesRowClass.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Definition.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    unset($options['grouping']);
    $options['card_header_field'] = ['default' => NULL];
    $options['card_image_field'] = ['default' => NULL];
    $options['card_image_option_field'] = ['default' => 'top'];
    $options['card_title_field'] = ['default' => NULL];
    $options['card_subtitle_field'] = ['default' => NULL];
    $options['card_body_field'] = ['default' => NULL];
    $options['card_footer_field'] = ['default' => NULL];
    $options['card_group_class_custom'] = ['default' => NULL];
    $options['card_group_columns'] = ['default' => 3];
    return $options;
  }

  /**
   * Render the given style.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    unset($form['grouping']);
    $form['help'] = [
      '#markup' => $this->t('The Bootstrap cards displays content in a flexible container (<a href=":docs">see documentation</a>). Note that any fields not assigned below will not be displayed.',
        [':docs' => 'https://getbootstrap.com/docs/5.0/components/card/']),
      '#weight' => -99,
    ];
    $form['card_header_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card header field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#empty_option' => $this->t('- Select -'),
      '#required' => FALSE,
      '#default_value' => $this->options['card_header_field'],
      '#description' => $this->t('Select the field that will be used for the card header. HTML tags will be stripped.'),
      '#weight' => 1,
    ];
    $form['card_image_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card image field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#empty_option' => $this->t('- Select -'),
      '#required' => FALSE,
      '#default_value' => $this->options['card_image_field'],
      '#description' => $this->t('Select the field that will be used for the card image.'),
      '#weight' => 2,
    ];
    $form['card_image_option_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Image placement'),
      '#description' => $this->t('Where to place the image in the card.'),
      '#options' => [
        'top' => $this->t('Top'),
        'bottom' => $this->t('Bottom'),
        'background' => $this->t('Background'),
      ],
      '#default_value' => $this->options['card_image_option_field'],
      '#weight' => 3,
    ];
    $form['card_title_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card title field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#empty_option' => $this->t('- Select -'),
      '#required' => FALSE,
      '#default_value' => $this->options['card_title_field'],
      '#description' => $this->t('Select the field that will be used for the card title. HTML tags will be stripped.'),
      '#weight' => 4,
    ];
    $form['card_subtitle_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card subtitle field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#empty_option' => $this->t('- Select -'),
      '#required' => FALSE,
      '#default_value' => $this->options['card_subtitle_field'],
      '#description' => $this->t('Select the field that will be used for the card subtitle. HTML tags will be stripped.'),
      '#weight' => 5,
    ];
    $form['card_body_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card content field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#empty_option' => $this->t('- Select -'),
      '#required' => TRUE,
      '#default_value' => $this->options['card_body_field'],
      '#description' => $this->t('Select the field that will be used for the card content body.'),
      '#weight' => 6,
    ];
    $form['card_footer_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card footer field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#empty_option' => $this->t('- Select -'),
      '#required' => FALSE,
      '#default_value' => $this->options['card_footer_field'],
      '#description' => $this->t('Select the field that will be used for the card footer.'),
      '#weight' => 7,
    ];
    $form['card_group_class_custom'] = [
      '#title' => $this->t('Custom card group class'),
      '#description' => $this->t('Additional classes to provide on the card group, separated by a space.'),
      '#type' => 'textfield',
      '#required' => FALSE,
      '#default_value' => $this->options['card_group_class_custom'],
      '#weight' => 8,
    ];
    $form['row_class']['#title'] = $this->t('Custom card class(es), separated by a space.');
    $form['row_class']['#weight'] = 9;
    $form['card_group_columns'] = [
      '#type' => 'select',
      '#title' => $this->t('Cards per row'),
      '#description' => $this->t('The max number of cards to include in a row in the largest responsive viewport.'),
      '#options' => [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
      ],
      '#required' => TRUE,
      '#default_value' => $this->options['card_group_columns'],
      '#weight' => 10,
    ];
  }

}
