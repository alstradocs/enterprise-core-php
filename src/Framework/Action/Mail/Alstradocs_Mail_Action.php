<?php

namespace Enterprise\Framework\Action\Mail;

/**
 *
 */
interface Alstradocs_Mail_Action
{
    /**
     *
     * @param data
     */
    public function alstradocs_mail($to, $from, $subject, $template, $template_data);
}
