<?php

namespace Enterprise\Framework\Ui\Template;


/**
 *
 */
trait Alstradocs_Data_Template
{

    use Alstradocs_Template {
        Alstradocs_Template::before_render as alstradocs_data_template_parent_before_render;
    }

  /**
   *
   * @param template_data The template data
   */
    protected function before_render($template_data)
    {
        $this->alstradocs_data_template_parent_before_render($template_data);

        if (!array_key_exists('data_provider', $template_data)) {
            throw new Alstradocs_Template_Exception("Invalid data provider");
        }

        $data_provider = $this->app->make($template_data['data_provider']);

        if(isset($_GET['id']) || filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $this->data = $data_provider->provide(['id' => $id]);
        }
        else {
            $this->data = $data_provider->provide($template_data);
        }
    }
}
