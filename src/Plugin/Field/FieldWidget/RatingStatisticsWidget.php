<?php

namespace Drupal\kifiform\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Simple captcha
 *
 * @FieldWidget(
 *   id = "kifiform_rating_statistics",
 *   label = @Translation("Statistics"),
 *   field_types = {
 *     "kifiform_rating"
 *   }
 * )
 */
class RatingStatisticsWidget extends WidgetBase {
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // NOTE: Using '#plain_text' won't work when value is '0'!


    $element['statistics'] = [
      '#type' => 'table',
      '#rows' => [
        [
          ['data' => [
          '#type' => 'item',
          '#title' => $this->t('Votes'),
          '#markup' => sprintf('%d', $items->votes),
          ]],
          ['data' => [
            '#type' => 'item',
            '#title' => $this->t('Rating'),
            '#markup' => str_repeat('*', ceil($items->value / 20)) ?: $this->t('No rating'),
          ]]
        ],
        [
          ['data' => [
            '#type' => 'item',
            '#title' => $this->t('Dislikes'),
            '#markup' => sprintf('%d', $items->down),
          ]],
          ['data' => [
            '#type' => 'item',
            '#title' => $this->t('Likes'),
            '#markup' => sprintf('%d', $items->up),
          ]]
        ]
      ]
    ];
    
    return $element;
  }
}
