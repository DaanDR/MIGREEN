<?php

class ErrorMessage
{
    private $strHtml;
    
    public function createErrorMessage($strError)
    {
        $this->strHtml = '<div class="error-message-container">
                <div id="close" class="close"></div>
                    <div class="error-message">' . $strError . '</div>
                </div>
            <div class="error-message-backgr"></div>';

        return $this->strHtml;
    }
}
?>