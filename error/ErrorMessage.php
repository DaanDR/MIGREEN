<?php

class ErrorMessage
{
    private $strHtml;
    
    public function createErrorMessage($strError)
    {
        $this->strHtml = '<div class="error-message-container">
                    <div class="error-message">
                        <div id="close" class="close"></div>'
                        . $strError . 
                        '</div>
                    </div>
            <div class="error-message-backgr"></div>';

        return $this->strHtml;
    }

    public function createErrorMessageButton($strError, $strUrl, $strButtName)
    {
        $this->strHtml = '<div class="error-message-container">
                    <div class="error-message">
                        <div id="close" class="close"></div>'
                        . $strError . 
                        '<br>
                        <button id="buttCancel" class="button-form-secondary" type="button" style="width: 80px; margin-top: 10px;">Cancel</button>
                        <button id="' . $strButtName .
                        '" class="button-form-delete" type="button" style="width: 80px; margin-top: 10px;">Ok</button>
                        </div>
                    </div>
            <div class="error-message-backgr"></div>
            <input id="error_message_url" type="hidden" value="' . $strUrl . '">';

        return $this->strHtml;
    }
}
?>