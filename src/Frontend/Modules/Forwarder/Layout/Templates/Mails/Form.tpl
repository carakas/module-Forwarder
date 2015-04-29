{include:/Core/Layout/Templates/Mails/Header.tpl}

<h2>{$msgForwarderSubject|sprintf:{$fromName}}</h2>
<hr/>

{option:message}
<h3>{$lblMessage|ucfirst}</h3>
  <p>{$message}</p>
{/option:message}

<a href="{$url}">See the link ({$pageTitle})</a>
{include:/Core/Layout/Templates/Mails/Footer.tpl}
