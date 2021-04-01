<?php


class Person
{

    private $name = '';

    public function get_person_name( $atts )
    {
      $atts = shortcode_atts(
          array(
              'type' => 'first',
          ), $atts, 'memorial_name' );

      $field_name_return = SELF::process_person_name();

      if ($atts['type'] == 'full') {
        return $field_name_return['full'];
      }

      return $this->name;
    }

    private function process_person_name()
    {
      $field_name = get_field('name');
      foreach ($field_name['variations'] as $field_name_instance) {
        $field_name_return[$field_name_instance['type']] = $field_name_instance['text'];
      }
      return $field_name_return;
    }
}

$person = new Person;

add_shortcode( 'memorial_name', array( $person, 'get_person_name' ) );
