<?php

namespace Enterprise\Framework\Action\Mail;

use Enterprise\Framework\Action\Alstradocs_Abstract_Action;
use Enterprise\Framework\Action\Mail\Alstradocs_Mail_Action;

/**
 *
 */
abstract class Alstradocs_Abstract_Mail_Action extends Alstradocs_Abstract_Action implements Alstradocs_Mail_Action
{
    /**
     *
     * @param data
     */
    public function alstradocs_mail($to, $from, $subject, $template, $template_data)
    {
        $mail_subject = $this->fill_text($subject, $template_data);
        $mail_message = $this->fill_template($template, $template_data);
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $mail_subject, $mail_message, $headers);
    }

    /**
     * @param text
     * @param data
     */
    protected function fill_text($text, $data)
    {
        return $this->fill_string($data, $text);;
    }

    /**
     * @param template_key
     * @param data
     */
    protected function fill_template($template_key, $data)
    {
        $template_content = $this->get_template_content($template_key, $data);
        return $this->fill_string($data, $template_content);;
    }

    /**
     * @param template_name
     */
    protected function get_template_content($template_name, $data) {
        $template = $this->app->make($template_name);
        ob_start();
        $template->render($data);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    /**
     * @param data
     * @param template_key
     */
    protected function fill_string($data, $template_content) {
        foreach ($data as $key => $data_value) {
            $place_holder = '[*' . $key . '*]';
            $template_content = str_replace($place_holder, $data_value, $template_content);
        }
        return $template_content;
    }
}
