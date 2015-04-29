<section id="searchFormWidget" class="mod">
    <div class="inner">
        <header class="hd">
            <h3>{$lblRecommendThisToAFriend|ucfirst}</h3>
        </header>
        <div class="bd">
            {form:forwarder}
                <p>
                    <label for="from_name">{$lblFrom|ucfirst} {$lblName|lowercase}<abbr title="{$lblRequiredField}">*</abbr></label>
                    {$txtFromName}{$txtFromNameError}
                </p>
                <p>
                    <label for="to_name">{$lblTo|ucfirst} {$lblName|lowercase}<abbr title="{$lblRequiredField}">*</abbr></label>
                    {$txtToName}{$txtToNameError}
                </p>
                <p>
                    <label for="from_email">{$lblFrom|ucfirst} {$lblEmail|lowercase}<abbr title="{$lblRequiredField}">*</abbr></label>
                    {$txtFromEmail}{$txtFromEmailError}
                </p>
                <p>
                    <label for="to_email">{$lblTo|ucfirst} {$lblEmail|lowercase}<abbr title="{$lblRequiredField}">*</abbr></label>
                    {$txtToEmail}{$txtToEmailError}
                </p>
                <p>
                    <label for="message">{$lblMessage|ucfirst}</label>
                    {$txtMessage}
                </p>
                <p>
                    <input id="submit" class="inputSubmit" type="submit" name="submit" value="{$lblSend|ucfirst}" />
                </p>
            {/form:forwarder}
        </div>
    </div>
</section>
