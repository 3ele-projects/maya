
<?php 
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_5f9f13ea21bad',
    'title' => 'color',
    'fields' => array(
        array(
            'key' => 'field_5f9f13ed30e01',
            'label' => 'color',
            'name' => 'color',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
            ),
            'allow_null' => 0,
            'other_choice' => 0,
            'default_value' => '',
            'layout' => 'vertical',
            'return_format' => 'value',
            'save_other_choice' => 0,
        ),
        array(
            'key' => 'field_5f9f145f4ffbb',
            'label' => 'date',
            'name' => 'date',
            'type' => 'date_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'display_format' => 'Y-m-d',
            'return_format' => 'Y-m-d',
            'first_day' => 1,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'color',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));

acf_add_local_field_group(array(
    'key' => 'group_5f1e9f6c76e30',
    'title' => 'events',
    'fields' => array(
        array(
            'key' => 'field_5f1e9f7fe7d74',
            'label' => 'atemuebung',
            'name' => 'atemuebung',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'atemuebung',
            ),
            'taxonomy' => '',
            'filters' => array(
                0 => 'search',
                1 => 'post_type',
                2 => 'taxonomy',
            ),
            'elements' => '',
            'min' => '',
            'max' => '',
            'return_format' => 'object',
        ),
        array(
            'key' => 'field_5f1eab4c09dfb',
            'label' => 'workout',
            'name' => 'workout',
            'type' => 'relationship',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'workout',
            ),
            'taxonomy' => '',
            'filters' => array(
                0 => 'search',
                1 => 'post_type',
                2 => 'taxonomy',
            ),
            'elements' => '',
            'min' => '',
            'max' => '',
            'return_format' => 'object',
        ),
        array(
            'key' => 'field_5f1eaf1b9c8de',
            'label' => 'color',
            'name' => 'color',
            'type' => 'select',
            'instructions' => 'green:green
blue:blue
yellow:yellow
red:red',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
            ),
            'default_value' => false,
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'return_format' => 'value',
            'ajax' => 0,
            'placeholder' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'tribe_events',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));

acf_add_local_field_group(array(
'key' => 'group_5fad1cfcc46c1',
'title' => 'cpt_by_color_from_day',
'fields' => array(
    array(
        'key' => 'field_5f9f13ed30e01',
        'label' => 'color',
        'name' => 'color',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'choices' => array(
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'default_value' => '',
        'layout' => 'vertical',
        'return_format' => 'value',
        'save_other_choice' => 0,
    ),
),
'location' => array(
    array(
        array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'atemuebung',
        ),
    ),
    array(
        array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'aufwaermuebung',
        ),
    ),
),
'menu_order' => 0,
'position' => 'normal',
'style' => 'default',
'label_placement' => 'top',
'instruction_placement' => 'label',
'hide_on_screen' => '',
'active' => true,
'description' => '',
));
acf_add_local_field_group(array(
    'key' => 'group_5f1eafe29a834',
    'title' => 'workout',
    'fields' => array(
        array(
            'key' => 'field_5faa9e9c2453e',
            'label' => 'seal',
            'name' => 'seal_image',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
    
    ),
    /*	array(
            'key' => 'field_5f1eb059739b6',
            'label' => 'siegel',
            'name' => 'siegel',
            'type' => 'text',
            'instructions' => 'Bild url',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        */
        array(
            'key' => 'field_5f1fe5fff6ce7',
            'label' => 'workout_siegel_id',
            'name' => 'seal_id',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'workout',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));

endif;
?>