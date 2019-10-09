<?php
function fco_customize_register( $wp_customize ) {
    $wp_customize->add_panel( 'main_panel', array(
        'title' => 'Головні налаштування сайту FCO',
        'priority' => 10,
     ) );

    //Рекламний банер Інтернет-магазину:
    {
        $wp_customize->add_section( 'fco_baner_shop' , array(
            'title'      => 'Банер інтернет-магазину',
            'panel' => 'main_panel',
            ) 
        );
        
        $wp_customize->add_setting(
            'fco_load_baner_shop',
            array(
                'transport'         => 'refresh',
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'shop_ads_file', 
                array(
                    'label'      => 'Банер',
                    'section'    => 'fco_baner_shop',
                    'settings' => 'fco_load_baner_shop',
                )
            )
        );

        $wp_customize->add_setting(
            'fco_load_url_shop',
            array(
                'transport'         => 'refresh',
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Control( 
                $wp_customize, 
                'shop_ads_url', 
                array(
                    'label'      => 'Посилання для переходу',
                    'section'    => 'fco_baner_shop',
                    'settings'   => 'fco_load_url_shop',
                    'type' => 'url',
                )
            )
        );
    }

    //Головний партнер
    {
        $wp_customize->add_section(
            'fco_main_partner',
            array(
                'title'      => 'Генеральний партнер',
                'panel' => 'main_panel',
                'description' => "Пам'ятайте, що активне і неактивне зображення мають мати однакові ширину та висоту!",
            ) 
        );
        
        $wp_customize->add_setting(
            'fco_main_partner_header_img',
            array(
                'transport'         => 'refresh',
                'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'fco_main_partner_header_img', 
                array(
                    'label'      => 'Зображення в хедері:',
                    'section'    => 'fco_main_partner',
                    'settings' => 'fco_main_partner_header_img',
                )
            )
        );
        
        $wp_customize->add_setting(
            'fco_main_partner_footer_active_img',
            array(
                'transport'         => 'refresh',
                'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'fco_main_partner_footer_active_img', 
                array(
                    'label'      => 'Зображення в футері (активне):',
                    'section'    => 'fco_main_partner',
                    'settings' => 'fco_main_partner_footer_active_img',
                )
            )
        );

        $wp_customize->add_setting(
            'fco_main_partner_footer_nonactive_img',
            array(
                'transport'         => 'refresh',
                'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Image_Control( 
                $wp_customize, 
                'fco_main_partner_footer_nonactive_img', 
                array(
                    'label'      => 'Зображення в футері (неактивне):',
                    'section'    => 'fco_main_partner',
                    'settings' => 'fco_main_partner_footer_nonactive_img',
                )
            )
        );

        $wp_customize->add_setting(
            'fco_main_partner_url',
            array(
                'transport'         => 'refresh',
                'default' => home_url(),
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Control( 
                $wp_customize, 
                'fco_main_partner_url', 
                array(
                    'label'      => 'Посилання для переходу:',
                    'section'    => 'fco_main_partner',
                    'settings'   => 'fco_main_partner_url',
                    'type' => 'url',
                )
            )
        );
    }

    //Спонсори - в футері
    {
        $wp_customize->add_section(
            'fco_sponsors_footer',
            array(
                'title'      => 'Спонсори клубу (у футері)',
                'panel' => 'main_panel',
                'description' => "Пам'ятайте, що активне і неактивне зображення мають мати однакові ширину та висоту!",
            ) 
        );
        
        //Спонсор №1
        {
            $wp_customize->add_setting(
                'fco_sponsors_footer_1_active_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_1_active_img', 
                    array(
                        'label'      => 'Спонсор №1 - активне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_1_active_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_1_nonactive_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_1_nonactive_img', 
                    array(
                        'label'      => 'Спонсор №1 - неактивне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_1_nonactive_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_1_url',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_1_url', 
                    array(
                        'label'      => 'Спонсор №1 - посилання:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_1_url',
                        'type' => 'url',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_1_alturl',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_1_alturl', 
                    array(
                        'label'      => 'Спонсор №1 - назва:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_1_alturl',
                    )
                )
            );
        }

        //Спонсор №2
        {
            $wp_customize->add_setting(
                'fco_sponsors_footer_2_active_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_2_active_img', 
                    array(
                        'label'      => 'Спонсор №2 - активне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_2_active_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_2_nonactive_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_2_nonactive_img', 
                    array(
                        'label'      => 'Спонсор №2 - неактивне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_2_nonactive_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_2_url',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_2_url', 
                    array(
                        'label'      => 'Спонсор №2 - посилання:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_2_url',
                        'type' => 'url',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_2_alturl',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_2_alturl', 
                    array(
                        'label'      => 'Спонсор №2 - назва:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_2_alturl',
                    )
                )
            );
        }

        //Спонсор №3
        {
            $wp_customize->add_setting(
                'fco_sponsors_footer_3_active_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_3_active_img', 
                    array(
                        'label'      => 'Спонсор №3 - активне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_3_active_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_3_nonactive_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_3_nonactive_img', 
                    array(
                        'label'      => 'Спонсор №3 - неактивне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_3_nonactive_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_3_url',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_3_url', 
                    array(
                        'label'      => 'Спонсор №3 - посилання:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_3_url',
                        'type' => 'url',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_3_alturl',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_3_alturl', 
                    array(
                        'label'      => 'Спонсор №3 - назва:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_3_alturl',
                    )
                )
            );
        }

        //Спонсор №4
        {
            $wp_customize->add_setting(
                'fco_sponsors_footer_4_active_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_4_active_img', 
                    array(
                        'label'      => 'Спонсор №4 - активне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_4_active_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_4_nonactive_img',
                array(
                    'transport'         => 'refresh',
                    'default' => get_template_directory_uri() . '/assets/img/gold-sponsor.png',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_4_nonactive_img', 
                    array(
                        'label'      => 'Спонсор №4 - неактивне зображення:',
                        'section'    => 'fco_sponsors_footer',
                        'settings' => 'fco_sponsors_footer_4_nonactive_img',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_4_url',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_4_url', 
                    array(
                        'label'      => 'Спонсор №4 - посилання:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_4_url',
                        'type' => 'url',
                    )
                )
            );

            $wp_customize->add_setting(
                'fco_sponsors_footer_4_alturl',
                array(
                    'transport'         => 'refresh',
                    'default' => home_url(),
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_footer_4_alturl', 
                    array(
                        'label'      => 'Спонсор №4 - назва:',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_footer_4_alturl',
                    )
                )
            );
        }

        //Порядок виведення спонсорів:
        {
            $wp_customize->add_setting(
                'fco_sponsors_order',
                array(
                    'transport'         => 'refresh',
                    'default' => '1,2,3,4',
                ) 
            );

            $wp_customize->add_control( 
                new WP_Customize_Control( 
                    $wp_customize, 
                    'fco_sponsors_order', 
                    array(
                        'label'      => 'В якому порядку виводити спонсорів:',
                        'description' => 'Вкажіть порядок виводу, через кому, наприклад "1,2,3,4"',
                        'section'    => 'fco_sponsors_footer',
                        'settings'   => 'fco_sponsors_order',
                    )
                )
            );
        }
    }

    //Поточний сезон:
    {
        $wp_customize->add_section( 'fco_ex_settings' , array(
            'title'      => 'Додаткові налаштування',
            'panel' => 'main_panel',
            ) 
        );
        
        

        $wp_customize->add_setting(
            'fco_ex_settings_seson',
            array(
                'transport'         => 'refresh',
            ) 
        );

        $wp_customize->add_control( 
            new WP_Customize_Control( 
                $wp_customize, 
                'fco_ex_settings_seson', 
                array(
                    'label'      => 'Дата поточного сезону',
                    'section'    => 'fco_ex_settings',
                    'settings'   => 'fco_ex_settings_seson',
                    'type' => 'text',
                )
            )
        );
    }
 }
 
 add_action( 'customize_register', 'fco_customize_register' );


//  echo '<pre>' . print_r(get_theme_mods(), 1) . '</pre>';

 ?>