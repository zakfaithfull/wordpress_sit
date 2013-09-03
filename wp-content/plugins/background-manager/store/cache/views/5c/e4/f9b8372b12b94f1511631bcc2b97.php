<?php

/* gallery_image.html.twig */
class __TwigTemplate_5ce4f9b8372b12b94f1511631bcc2b97 extends Twig_Template
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
<div id=\"image_nav\" class=\"tablenav hide-if-js\">
    <div id=\"image_upload_html\">
        <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
            ";
        // line 11
        if (isset($context["nonce"])) { $_nonce_ = $context["nonce"]; } else { $_nonce_ = null; }
        echo $_nonce_;
        echo "
            <label class=\"screen-reader-text\" for=\"upload_file\">";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Add Image"), "html", null, true);
        echo "</label>
            <input type=\"file\" name=\"upload_file\" id=\"upload_file /\">
            <input type=\"submit\" name=\"upload\" id=\"upload\" class=\"button\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Add Image"), "html", null, true);
        echo "\" />
        </form>
    </div>
    <div id=\"image_nav_page_links\" class=\"tablenav-pages\">";
        // line 17
        if (isset($context["page_links"])) { $_page_links_ = $context["page_links"]; } else { $_page_links_ = null; }
        echo $_page_links_;
        echo "</div>
</div>

<div id=\"image_container\">
    ";
        // line 21
        if (isset($context["images"])) { $_images_ = $context["images"]; } else { $_images_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_images_);
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 22
            echo "    <div id=\"image_";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "ID"), "html", null, true);
            echo "\" class=\"image myatu_inline_block\">
        <img src=\"";
            // line 23
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_image_, "thumb"), 0), "html", null, true);
            echo "\" alt=\"";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_image_, "meta_alt"), "html", null, true);
            echo "\" title=\"";
            if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
            if ($this->getAttribute($_image_, "post_excerpt")) {
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "post_excerpt"), "html", null, true);
            } else {
                if (isset($context["image"])) { $_image_ = $context["image"]; } else { $_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_image_, "post_name"), "html", null, true);
            }
            echo "\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 26
        echo "</div>

<div id=\"image_buttons\" class=\"image_buttons\">
    <a href=\"#\" id=\"image_edit_button\"   class=\"image_button myatu_inline_block\" title=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Edit Image"), "html", null, true);
        echo "\"   accesskey=\"e\"></a>
    <a href=\"#\" id=\"image_del_button\"    class=\"image_button myatu_inline_block\" title=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Delete Image"), "html", null, true);
        echo "\" accesskey=\"d\"></a>
    <a href=\"#\" id=\"image_remove_button\" class=\"image_button myatu_inline_block\" title=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Remove Image"), "html", null, true);
        echo "\" accesskey=\"r\"></a>
</div>

<div id=\"image_move_left_button_holder\" class=\"image_buttons\">
    <a href=\"#\" id=\"image_move_left_button\" class=\"image_button\" title=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Move Left"), "html", null, true);
        echo "\"  accesskey=\"n\"></a>
</div>

<div id=\"image_move_right_button_holder\" class=\"image_buttons\">
    <a href=\"\" id=\"image_move_right_button\" class=\"image_button\" title=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('translate')->transFilter("Move Right"), "html", null, true);
        echo "\" accesskey=\"m\"></a>
</div>

<script type=\"text/javascript\">
//<![CDATA[
jQuery(document).ready(function(\$){
    mainWin = window.dialogArguments || opener || parent || top;
    mainWin.myatu_bgm.onImagesIframeFinish(";
        // line 46
        if (isset($context["current_page"])) { $_current_page_ = $context["current_page"]; } else { $_current_page_ = null; }
        echo twig_escape_filter($this->env, $_current_page_, "html", null, true);
        echo ");
});
//]]>
</script>
";
    }

    public function getTemplateName()
    {
        return "gallery_image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 46,  109 => 39,  102 => 35,  95 => 31,  91 => 30,  87 => 29,  82 => 26,  60 => 23,  54 => 22,  49 => 21,  41 => 17,  35 => 14,  30 => 12,  25 => 11,  19 => 7,);
    }
}
