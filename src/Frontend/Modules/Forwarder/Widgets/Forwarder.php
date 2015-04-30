<?php

namespace Frontend\Modules\Forwarder\Widgets;

use Frontend\Core\Engine\Base\Widget as FrontendBaseWidget;
use Frontend\Core\Engine\Form as FrontendForm;
use Frontend\Core\Engine\Language as FL;
use Common\Mailer\Message;

/**
 * This is the forwarder-widget: Recommend a friend.
 *
 * @author Lander Vanderstraeten <lander_vanderstraeten@hotmail.com>
 */
class Forwarder extends FrontendBaseWidget
{
    /**
     * @var FrontendForm
     */
    protected $frm;

    /**
     * Execute.
     */
    public function execute()
    {
        parent::execute();
        $this->loadTemplate();
        $this->loadForm();
        $this->validateForm();
        $this->parse();
    }

    /**
     * Load form.
     */
    private function loadForm()
    {
        // create form
        $this->frm = new FrontendForm('forwarder', null, 'post', null, false);
        $this->frm->addText('from_name', null, 255, 'inputText', 'inputTextError');
        $this->frm->addText('to_name', null, 255, 'inputText', 'inputTextError');
        $this->frm->addText('from_email', null, 255, 'inputText', 'inputTextError');
        $this->frm->addText('to_email', null, 255, 'inputText', 'inputTextError');
        $this->frm->addTextarea('message', null, 'inputText ', 'inputTextError');
    }

    /**
     * Validate form.
     */
    private function validateForm()
    {
        // submitted
        if ($this->frm->isSubmitted()) {
            // cleanup the submitted fields, ignore fields that were added by hackers
            $this->frm->cleanupFields();

            // get fields
            $txtFromName = $this->frm->getField('from_name');
            $txtToName = $this->frm->getField('to_name');
            $txtFromEmail = $this->frm->getField('from_email');
            $txtToEmail = $this->frm->getField('to_email');
            $txtFormMessage = $this->frm->getField('message');

            // check required fields
            $txtFromName->isFilled(FL::getError('NameIsRequired'));
            $txtToName->isFilled(FL::getError('NameIsRequired'));
            $txtFromEmail->isFilled(FL::getError('EmailIsRequired'));
            $txtToEmail->isFilled(FL::getError('EmailIsRequired'));

            // valid form
            if ($this->frm->isCorrect()) {
                // get values
                $fromName = $txtFromName->getValue();
                $toName = $txtToName->getValue();
                $fromEmail = $txtFromEmail->getValue();
                $toEmail = $txtToEmail->getValue();
                $formMessage = $txtFormMessage->getValue() ?: null;

                // get url
                $url = SITE_URL.'/'.$this->URL->getQueryString();

                // get page title
                $pageTitle = $this->header->getPageTitle();

                // create message
                $message = Message::newInstance(
                    sprintf(FL::getMessage('ForwarderSubject'), $fromName)
                )
                    ->parseHtml(
                        FRONTEND_MODULES_PATH.'/Forwarder/Layout/Templates/Mails/Form.tpl',
                        array(
                            'fromName' => $fromName,
                            'pageTitle' => $pageTitle,
                            'message' => $formMessage,
                            'url' => $url,
                        ),
                        true
                    )
                    ->setTo(array($toEmail => $toName))
                    ->setFrom(array($fromEmail => $fromName))
                    ->setReplyTo(array($fromEmail => $fromName));
                $this->get('mailer')->send($message);
            } else {
                // not correct, show errors
                if ($this->frm->getErrors() != '') {
                    $this->tpl->assign('forwarder', $this->frm->getErrors());
                } else {
                    // general error
                    $this->tpl->assign('forwarder', FL::err('Required'));
                }
            }
        }
    }

    /**
     * Parse.
     */
    private function parse()
    {
        $this->frm->parse($this->tpl);
    }
}
