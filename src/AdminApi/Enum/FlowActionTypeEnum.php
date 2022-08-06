<?php

/** @noinspection SpellCheckingInspection */

namespace Playtini\KeitaroClient\AdminApi\Enum;

enum FlowActionTypeEnum: string
{
    case LocalFile = 'local_file';
    case Http = 'http';
    case Curl = 'curl'; // payload - url
    case Status404 = 'status404';
    case ShowText = 'show_text'; // payload - text
    case ShowHtml = 'show_html'; // payload - html
    case Campaign = 'campaign'; // payload - campaign_id
    case DoNothing = 'do_nothing';
    case MetaRedirect = 'meta';
    case DoubleMetaRedirect = 'double_meta';
    case JsRedirect = 'js';
    case JsRedirectDeprecated = 'js_for_script';
    case JsIframeRedirectDeprecated = 'js_for_iframe';
    case BlackReferrerRedirect = 'blank_referrer';
    case FormSubmitRedirect = 'formsubmit';
    case IframeOpen = 'iframe';
    case RemoteRedirect = 'remote'; // open url contents and use it as a next url for redirection
    case FrameOpen = 'frame'; // open if frameset (outdated)
}
