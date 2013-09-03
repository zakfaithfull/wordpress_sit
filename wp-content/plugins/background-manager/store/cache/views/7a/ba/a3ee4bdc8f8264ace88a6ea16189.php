<?php

/* meta_gallery_submit.html.twig */
class __TwigTemplate_7abaa3ee4bdc8f8264ace88a6ea16189 extends Twig_Template
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
<div class=\"submitbox\" id=\"submitpost\">
    <div id=\"minor-publishing\">
        <div style=\"display:none;\">
            <p class=\"submit\">
                <input id=\"save\" class=\"button\" type=\"submit\" name=\"submit\" value=\"";
        // line 12
        if (isset($context["save_btn_title"])) { $_save_btn_title_ = $context["save_btn_title"]; } else { $_save_btn_title_ = null; }
        echo twig_escape_filter($this->env, $_save_btn_title_, "html", null, true);
        echo "\" />
            </p>
        </div>
        ";
        // line 15
        if (isset($context["gallery_id"])) { $_gallery_id_ = $context["gallery_id"]; } else { $_gallery_id_ = null; }
        if ($_gallery_id_) {
            // line 16
            echo "        <div style=\"padding:0 10px\">
            <p>
                ";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Gallery Shortcode:"), "html", null, true);
            echo " <code>[gallery id=&quot;";
            if (isset($context["gallery_id"])) { $_gallery_id_ = $context["gallery_id"]; } else { $_gallery_id_ = null; }
            echo twig_escape_filter($this->env, $_gallery_id_, "html", null, true);
            echo "&quot;]</code>
            </p>
        </div>
        ";
        }
        // line 22
        echo "        <div class=\"misc-pub-section-last\" style=\"padding: 0 10px 10px\">
            <p><label for=\"post_content\">";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Short Description"), "html", null, true);
        echo ":</label></p>
            <textarea id=\"post_content\" name=\"post_content\" class=\"large-text\" rows=\"3\" cols=\"30\" style=\"width:100%;\" tabindex=\"4\">";
        // line 24
        if (isset($context["gallery"])) { $_gallery_ = $context["gallery"]; } else { $_gallery_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_gallery_, "post_content"), "html", null, true);
        echo "</textarea>
            <div class=\"clear\"></div>
        </div>
    </div>
    <div id=\"major-publishing-actions\">
        ";
        // line 29
        if (isset($context["show_delete_action"])) { $_show_delete_action_ = $context["show_delete_action"]; } else { $_show_delete_action_ = null; }
        if ($_show_delete_action_) {
            // line 30
            echo "        <div id=\"delete-action\">
            <a href=\"";
            // line 31
            if (isset($context["delete_action"])) { $_delete_action_ = $context["delete_action"]; } else { $_delete_action_ = null; }
            echo $this->getAttribute($_delete_action_, "url");
            echo "\" title=\"";
            if (isset($context["delete_action"])) { $_delete_action_ = $context["delete_action"]; } else { $_delete_action_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_delete_action_, "title"), "html", null, true);
            echo "\" class=\"submitdelete deletion\">";
            if (isset($context["delete_action"])) { $_delete_action_ = $context["delete_action"]; } else { $_delete_action_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_delete_action_, "text"), "html", null, true);
            echo "</a>
        </div>
        ";
        }
        // line 34
        echo "        <div id=\"publishing-action\">
            <input name=\"submit\" type=\"submit\" class=\"button-primary\" id=\"publish\" tabindex=\"5\" accesskey=\"p\" value=\"";
        // line 35
        if (isset($context["save_btn_title"])) { $_save_btn_title_ = $context["save_btn_title"]; } else { $_save_btn_title_ = null; }
        echo twig_escape_filter($this->env, $_save_btn_title_, "html", null, true);
        echo "\" />
        </div>
        <div class=\"clear\"></div>
    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "meta_gallery_submit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 35,  85 => 34,  72 => 31,  69 => 30,  66 => 29,  57 => 24,  53 => 23,  50 => 22,  40 => 18,  36 => 16,  26 => 12,  39 => 14,  28 => 11,  24 => 10,  37 => 14,  33 => 15,  27 => 10,  23 => 9,  19 => 7,);
    }
}
