<?php

/* meta_gallery_link.html.twig */
class __TwigTemplate_0a35e86033eea29b6e7022dea59ab96e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 7
        echo "
<p id=\"image_link_desc\">
    ";
        // line 9
        echo $this->env->getExtension('translate')->transFilter("By default, the <code>[ + ]</code> icon will be linked to a page containing more details about the background image displayed.");
        echo "
    ";
        // line 10
        echo $this->env->getExtension('translate')->transFilter("Specifying a URL here allows you to override that link to, for example, a gallery. For your convenience, shortcodes (i.e., <code>[gallery_url 1]</code>) are accepted.");
        echo "
</p>
<label>
    ";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Background Image Link"), "html", null, true);
        echo "
    <input type=\"text\" id=\"image_link\" name=\"image_link\" style=\"width:100%\" value=\"";
        // line 14
        if (isset($context["image_link"])) { $_image_link_ = $context["image_link"]; } else { $_image_link_ = null; }
        echo twig_escape_filter($this->env, $_image_link_, "html", null, true);
        echo "\" tabindex=\"3\" />
</label>


";
    }

    public function getTemplateName()
    {
        return "meta_gallery_link.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 14,  33 => 13,  27 => 10,  23 => 9,  19 => 7,);
    }
}
