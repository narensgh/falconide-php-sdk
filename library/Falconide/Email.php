<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Email
 *
 * @author narendra
 */

namespace Falconide;

class Email
{

    private
        $from,
        $fromname,
        $recipients,
        $subject,
        $content;

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function getFrom()
    {
        if (empty($this->from)) {
            throw new \Exception('from is blank');
        }
        return $this->from;
    }

    public function setFromname($fromname)
    {
        $this->fromname = $fromname;
    }

    public function getFromname()
    {
        return $this->fromname;
    }

    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }

    public function getRecipients()
    {
        if (empty($this->recipients)) {
            throw new \Exception('Recipients is blank');
        }
        return $this->recipients;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        if (empty($this->subject)) {
            throw new \Exception('subject is blank');
        }
        return $this->subject;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        if (empty($this->content)) {
            throw new \Exception('content is blank');
        }

        return $this->content;
    }

    public function toApiMailFormat()
    {
        $data = array(
            'subject' => $this->getSubject(),
            'from' => $this->getFrom(),
            'recipients' => $this->getRecipients(),
            'content' => $this->getContent()
        );
        if (!empty($this->getFromname())) {
            $data['fromname'] = $this->getFromname();
        }
        return $data;
    }

}