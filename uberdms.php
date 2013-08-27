<?php
/*
Plugin Name: UberDMS
Author: Soulhuntre
Author URI: http://www.samuraideveloper.com
Version: 1.0
Description: A simple section to allow simple placement of an UberMenu
Class Name: UberDMSSection
PageLines: true
Section: true
*/


/**
 * IMPORTANT
 * This tells wordpress to not load the class as DMS will do it later when the main sections API is available.
 * If you want to include PHP earlier like a normal plugin just add it above here.
 */
if( ! class_exists( 'PageLinesSection' ) )
    return;


/**
 * Start of section class.
 */
class UberDMSSection extends PageLinesSection {
/*
    function section_scripts(){
    }

    function section_head(){
    }
*/
    function section_opts() {

        // using a select here, not a checkbox, to avoid the broken DMS checkbox UI conventions

        $opts = array(
            array(
                'title'		=> 'UberDMS Options',
                'type'		=> 'multi',
                'opts'		=> array(

                    array(
                        'key'	=> 'uberdms-enabled',
                        'type'	=> 'select',
                        'label'	=> 'UberDMS Enabled',
                        'opts'  => array(
                            'enabled'   => array( 'name' => 'Enabled' ),
                            'disabled'  => array( 'name' => 'Disabled' )
                        ),
                    ),
                )
            )
        );
        return $opts;
    }

    function section_template(){

        $enabled =  ($this->opt('uberdms-enabled', array( 'default' => 'enabled')) == 'enabled');

        if( $enabled ){
            if( function_exists('uberMenu_direct') ){
                if( has_nav_menu( 'ubermenu' ) ){
                    uberMenu_direct( 'ubermenu' );
                }
                else{
                    echo 'Please enable UberMenu <a href="http://sevenspark.com/docs/ubermenu-easy-integration" title="Permalink to Easy Integration" rel="bookmark">Easy Integration</a> and set a menu in the "UberMenu" Theme Location';
                }
            }
        }else{
            echo '<div class="alert">UberDMS Disabled</div>';
        }
    }
}