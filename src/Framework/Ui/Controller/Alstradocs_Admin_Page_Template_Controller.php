<?php

namespace Enterprise\Framework\Ui\Controller;

/**
 *
 */
class Alstradocs_Admin_Page_Template_Controller extends Alstradocs_Abstract_Template_Controller
{

    /**
     */
    public function do_register()
    {
        parent::do_register();
        $this->loader->add_action('admin_menu', $this, 'add_menu');
    }

    /**
     */
    public function add_menu()
    {
        if (array_key_exists('menu_type', $this->config_data)) {
            if ($this->config_data['menu_type'] === 'main') {
                $this->add_main_menu($this->config_data, $this->app);
                $this->add_sub_menu($this->config_data, $this->app);
            } else {
                $this->add_sub_menu($this->config_data, $this->app);
            }
        }
    }

    /**
     * @param menu_data
     */
    protected function add_main_menu($menu_data, $app)
    {
        return add_menu_page(
            $menu_data['page_title'],
            $menu_data['menu_title'],
            $menu_data['capability'],
            $menu_data['menu_slug'],
            [$this, 'render_template'],
            $menu_data['icon'],
            $menu_data['position']
        );
    }

    /**
     * @param menu_data
     */
    protected function add_sub_menu($menu_data, $app)
    {
        if (!array_key_exists('parent_menu_slug', $menu_data)) {
            $menu_data['parent_menu_slug'] = $menu_data['menu_slug'];
        }
        if ($menu_data['menu_type'] === 'main' && array_key_exists('sub_menu_title', $menu_data)) {
            $menu_data['menu_title'] = $menu_data['sub_menu_title'];
            $menu_data['position'] = 1;
        }
        return add_submenu_page(
            $menu_data['parent_menu_slug'],
            $menu_data['page_title'],
            $menu_data['menu_title'],
            $menu_data['capability'],
            $menu_data['menu_slug'],
            [$this, 'render_template'],
            $menu_data['position']
        );
    }
}
