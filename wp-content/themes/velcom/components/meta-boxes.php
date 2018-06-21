<?php
/**
 * Initialize the custom Meta Boxes. 
 */
add_action( 'admin_init', 'custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types in demo-theme-options.php.
 *
 * @return    void
 * @since     2.0
 */
function custom_meta_boxes() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */

  $main_page_meta_box = array(
    'id'          => 'main_meta_box',
    'title'       => 'Настройки главной страницы',
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
// SEO
      array(
        'label'       => 'Данные для SEO',
        'id'          => 'seo',
        'type'        => 'tab'
      ),    
      array(
        'id'          => 'seo-title',
        'label'       => 'Title',
        'std'         => '',
        'type'        => 'text'
      ),
      array(
        'id'          => 'seo-description',
        'label'       => 'Description',
        'desc'        => '  ',
        'std'         => '',
        'type'        => 'textarea'
      ),
// Last block
      array(
        'label'       => 'Последний блок',
        'id'          => 'dermat-agent',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'dermat-agent_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),     
      array(
        'id'          => 'dermat-agent_img',
        'label'       => ' ',
        'desc'        => '  ',
        'std'         => '',
        'type'        => 'upload'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'dermat-agent_title',
        'type'        => 'text',
        'desc'        => '  '
      ),
      array(
        'label'       => 'Текст',
        'id'          => 'dermat-agent_text',
        'type'        => 'textarea'      
      ),
// History
      array(
        'label'       => 'Блок "Книга"',
        'id'          => 'book',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'book_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Истории',
        'id'          => 'book_history',
        'type'        => 'list-item',
        'desc'        => 'Список историй. Можно перетягиванием поменять порталы местами. Поле title - название в списке.',
        'std'         => '',
        'condition'   => 'book_onoff:is(on)',
        'settings'    => array(
          array(
            'id'          => 'book_select',
            'label'       => 'Истории',
            'desc'        => 'Истории',
            'type'        => 'custom-post-type-select',
            'post_type'   => 'dfnd_history'
          )
        )
      ),
      array(
        'id'          => 'book_rules',
        'label'       => 'Ссылка на правила',
        'desc'        => '  ',
        'std'         => '',
        'type'        => 'upload'
      ),
// Where can by
      array(
        'label'       => 'Блок "Где купить"',
        'id'          => 'where',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'where_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'where_title',
        'type'        => 'text',
        'desc'        => ' ',
        'std'         => ''
      ),
      array(
        'label'       => 'Порталы',
        'id'          => 'where_list',
        'type'        => 'list-item',
        'desc'        => 'Список порталов. Можно перетягиванием поменять порталы местами. Поле title - название в списке.',
        'std'         => '',
        'condition'   => 'where_onoff:is(on)',
        'settings'    => array(          
          array(
            'id'          => 'where_select',
            'label'       => 'Магазины',
            'desc'        => '  ',
            'type'        => 'custom-post-type-select',
            'post_type'   => 'dfnd_shop'
          ),
          array(
            'id'          => 'where_url',
            'label'       => 'Ссылка для перехода',
            'desc'        => '  ',
            'type'        => 'text',
          )
        )
      ),
// Different histories - video
      array(
        'label'       => 'Блок "Другие истории"',
        'id'          => 'hist',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'hist_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'desc'        => ' ',
        'id'          => 'hist_title',
        'type'        => 'text',
        'desc'        => ' ',
        'std'         => ''
      ),
      array(
        'label'       => 'Текст',
        'desc'        => ' ',
        'id'          => 'hist_text',
        'type'        => 'textarea',
        'desc'        => ' ',
        'std'         => ''
      ),
      array(
        'label'       => 'Видео',
        'id'          => 'hist_list',
        'type'        => 'list-item',
        'desc'        => 'Видео с другими историями. Можно перетягиванием поменять порталы местами. Поле title - название в списке.',
        'std'         => '',
        'condition'   => 'hist_onoff:is(on)',
        'settings'    => array(
          array(
            'label'       => 'Ссылка на видео',
            'id'          => 'hist_item_link',
            'type'        => 'text',
            'desc'        => 'Видео с youtube.'
          )
        )
      ),
// Comments
      array(
        'label'       => 'Блок "Отзывы"',
        'id'          => 'comm',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'comm_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'comm_title',
        'type'        => 'text',
        'desc'        => ' ',
        'std'         => ''
      ),
      array(
        'label'       => 'Отзывы',
        'id'          => 'comm_list',
        'type'        => 'list-item',
        'desc'        => 'Отзывы. Можно перетягиванием поменять порталы местами. Поле title - название в списке.',
        'std'         => '',
        'condition'   => 'comm_onoff:is(on)',
        'settings'    => array(
          array(
            'id'          => 'comm_select',
            'label'       => 'Коментарий',
            'desc'        => '  ',
            'type'        => 'custom-post-type-select',
            'post_type'   => 'dfnd_comment'
          )
        )
      ),
// How is work 
      array(
        'label'       => 'Блок "Как работает крем защитник"',
        'id'          => 'how',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'how_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'how_title',
        'type'        => 'text',
        'desc'        => '  '
      )
    )
  );

  $about_page_meta_box = array(
    'id'          => 'about_meta_box',
    'title'       => 'Настройки страницы "О продукте"',
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
// Description
      array(
        'label'       => 'Блок "Описание"',
        'id'          => 'description',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'description_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'description_title',
        'type'        => 'text',
        'desc'        => ' ',
        'condition'   => 'description_onoff:is(on)'
      ),
      array(
        'label'       => 'Заголовок к тексту',
        'id'          => 'description_title_p',
        'type'        => 'text',
        'desc'        => ' ',
        'condition'   => 'description_onoff:is(on)'
      ),
      array(
        'label'       => 'Текст',
        'id'          => 'description_text',
        'type'        => 'textarea',
        'desc'        => 'Описание продукта.',
        'condition'   => 'description_onoff:is(on)'
      ),
      array(
        'label'       => 'Картинка к описанию',
        'id'          => 'description_img',
        'type'        => 'upload',
        'desc'        => '   ',
        'condition'   => 'description_onoff:is(on)'
      ),
// Use
      array(
        'label'       => 'Блок "Применение"',
        'id'          => 'use',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'use_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'use_title',
        'type'        => 'text',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Заголовок первого блока',
        'id'          => 'use_title_1',
        'type'        => 'text',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Текст первого блока',
        'id'          => 'use_text_1',
        'type'        => 'textarea',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Заголовок второго блока',
        'id'          => 'use_title_2',
        'type'        => 'text',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Текст второго блока',
        'id'          => 'use_text_2',
        'type'        => 'textarea',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Заголовок третьего блока',
        'id'          => 'use_title_3',
        'type'        => 'text',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Текст третьего блока',
        'id'          => 'use_text_3',
        'type'        => 'textarea',
        'desc'        => '  ',
        'condition'   => 'use_onoff:is(on)'
      ),
      array(
        'label'       => 'Инструкция к применению',
        'id'          => 'use_upload',
        'type'        => 'upload',
        'desc'        => 'Файл формата PDF',
        'condition'   => 'use_onoff:is(on)'
      ),
// Comments
      array(
        'label'       => 'Блок "Отзывы"',
        'id'          => 'comm',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'comm_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'comm_title',
        'type'        => 'text',
        'desc'        => ' ',
        'std'         => ''
      ),
      array(
        'label'       => 'Отзывы',
        'id'          => 'comm_list',
        'type'        => 'list-item',
        'desc'        => 'Отзывы. Можно перетягиванием поменять порталы местами. Поле title - название в списке.',
        'std'         => '',
        'condition'   => 'comm_onoff:is(on)',
        'settings'    => array(
          array(
            'id'          => 'comm_select',
            'label'       => 'Коментарий',
            'desc'        => '  ',
            'type'        => 'custom-post-type-select',
            'post_type'   => 'dfnd_comment'
          )
        )
      ),
// Where can by
      array(
        'label'       => 'Блок "Где купить"',
        'id'          => 'where',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Показывать блок',
        'id'          => 'where_onoff',
        'type'        => 'on-off',
        'desc'        => 'Отображать или нет блок на странице',
        'std'         => 'on'
      ),
      array(
        'label'       => 'Заголовок',
        'id'          => 'where_title',
        'type'        => 'text',
        'desc'        => ' ',
        'std'         => ''
      ),
      array(
        'label'       => 'Порталы',
        'id'          => 'where_list',
        'type'        => 'list-item',
        'desc'        => 'Список порталов. Можно перетягиванием поменять порталы местами. Поле title - название в списке.',
        'std'         => '',
        'condition'   => 'where_onoff:is(on)',
        'settings'    => array(          
          array(
            'id'          => 'where_select',
            'label'       => 'Магазины',
            'desc'        => '  ',
            'type'        => 'custom-post-type-select',
            'post_type'   => 'dfnd_shop'
          ),
          array(
            'id'          => 'where_url',
            'label'       => 'Ссылка',
            'desc'        => '  ',
            'type'        => 'text'
          )
        )
      )

    )
  );

  $demo_meta_box = array(
    'id'          => 'demo_meta_box',
    'title'       => __( 'Demo Meta Box', 'theme-text-domain' ),
    'desc'        => '',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => __( 'Conditions', 'theme-text-domain' ),
        'id'          => 'demo_conditions',
        'type'        => 'tab'
      ),
      array(
        'label'       => __( 'Show Gallery', 'theme-text-domain' ),
        'id'          => 'demo_show_gallery',
        'type'        => 'on-off',
        'desc'        => sprintf( __( 'Shows the Gallery when set to %s.', 'theme-text-domain' ), '<code>on</code>' ),
        'std'         => 'off'
      ),
      array(
        'label'       => '',
        'id'          => 'demo_textblock',
        'type'        => 'textblock',
        'desc'        => __( 'Congratulations, you created a gallery!', 'theme-text-domain' ),
        'operator'    => 'and',
        'condition'   => 'demo_show_gallery:is(on),demo_gallery:not()'
      ),
      array(
        'label'       => __( 'Gallery', 'theme-text-domain' ),
        'id'          => 'demo_gallery',
        'type'        => 'gallery',
        'desc'        => sprintf( __( 'This is a Gallery option type. It displays when %s.', 'theme-text-domain' ), '<code>demo_show_gallery:is(on)</code>' ),
        'condition'   => 'demo_show_gallery:is(on)'
      ),
      array(
        'label'       => __( 'More Options', 'theme-text-domain' ),
        'id'          => 'demo_more_options',
        'type'        => 'tab'
      ),
      array(
        'label'       => __( 'Text', 'theme-text-domain' ),
        'id'          => 'demo_text',
        'type'        => 'text',
        'desc'        => __( 'This is a demo Text field.', 'theme-text-domain' )
      ),
      array(
        'label'       => __( 'Textarea', 'theme-text-domain' ),
        'id'          => 'demo_textarea',
        'type'        => 'textarea',
        'desc'        => __( 'This is a demo Textarea field.', 'theme-text-domain' )
      )
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */

  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
  $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
  // var_dump($template_file);

  if ($template_file == 'main-page.php') {
      //ot_register_meta_box( $main_page_meta_box );
  }
  else if ($template_file == 'about-page.php') {
      //ot_register_meta_box( $about_page_meta_box );
  }

}