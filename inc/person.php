<?php


class Person
{


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

    }

    private function process_person_name()
    {
      $field_name = get_field('name');

      foreach ($field_name['variations'] as $field_name_instance) {

        $field_name_return[$field_name_instance['type']] = $field_name_instance['text'];

      }

      return $field_name_return;
    }


    public function get_person_about( $atts )
    {
      $atts = shortcode_atts(
          array(
              'type' => 'bio',
          ), $atts, 'memorial_about' );

      $field_about_return = SELF::process_person_about();

      return $field_about_return[$atts['type']];

    }

    private function process_person_about()
    {
      $field_about = get_field('about');

      foreach ($field_about['variations'] as $field_about_instance) {

        $field_about_return[$field_about_instance['type']] = $field_about_instance['text'];

      }

      return $field_about_return;
    }


    public function get_person_location( $atts )
    {
      $atts = shortcode_atts(
          array(
              'type' => 'birthplace',
          ), $atts, 'memorial_location' );

      $field_location_return = SELF::process_person_location();

      return $field_location_return[$atts['type']];

    }

    private function process_person_location()
    {
      $field_location = get_field('location');

      foreach ($field_location['variations'] as $field_location_instance) {

        $field_location_return[$field_location_instance['type']] = $field_location_instance['text'];

      }

      return $field_location_return;
    }


    public function get_person_time( $atts )
    {
      $atts = shortcode_atts(
          array(
              'type' => 'age',
          ), $atts, 'memorial_time' );

      $field_time_return = SELF::process_person_time();

      if (($atts['type'] == 'birthdate') || ($atts['type'] == 'deathdate')) {
        return date_format($field_time_return[$atts['type']], 'F j, Y');
        // return date_format($atts['type'], 'F j, Y');
      }

      if ($atts['type'] == 'age') {
        return date_diff(date_create(date_format($field_time_return['birthdate'], 'F j, Y')), date_create(date_format($field_time_return['deathdate'], 'F j, Y')))->y;
      }

    }

    private function process_person_time()
    {
      $field_time = get_field('date');

      foreach ($field_time['variations'] as $field_time_instance) {

        $field_time_return[$field_time_instance['type']] = date_create_from_format('Ymd', $field_time_instance['date']);

      }

      return $field_time_return;
    }
}

$person = new Person;

add_shortcode( 'memorial_name', array( $person, 'get_person_name' ) );
add_shortcode( 'memorial_location', array( $person, 'get_person_location' ) );
add_shortcode( 'memorial_time', array( $person, 'get_person_time' ) );
add_shortcode( 'memorial_about', array( $person, 'get_person_about' ) );
