<?php

/* pub_footer.html.twig */
class __TwigTemplate_14c4252fe42855206ca36b30b6be80a1 extends Twig_Template
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
<!-- Background Manager Start -->
";
        // line 9
        ob_start();
        // line 10
        echo "
";
        // line 12
        if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
        if ($this->getAttribute($_random_image_, "bg_link")) {
            echo "<a id=\"myatu_bgm_bg_link\" class=\"myatu_bgm_fs\" href=\"";
            if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_random_image_, "bg_link"), "html", null, true);
            echo "\"></a>";
        }
        // line 13
        echo "
";
        // line 15
        if (isset($context["has_overlay"])) { $_has_overlay_ = $context["has_overlay"]; } else { $_has_overlay_ = null; }
        if ($_has_overlay_) {
            echo "<div id=\"myatu_bgm_overlay\" class=\"myatu_bgm_fs\"></div>";
        }
        // line 16
        echo "
";
        // line 18
        if (isset($context["is_fullsize"])) { $_is_fullsize_ = $context["is_fullsize"]; } else { $_is_fullsize_ = null; }
        if ($_is_fullsize_) {
            // line 19
            echo "<div id=\"myatu_bgm_img_group\" class=\"myatu_bgm_fs\" style=\"overflow: hidden;\">
    <script type=\"text/javascript\">
    /*<![CDATA[*/
    ";
            // line 39
            echo "    try{(function(a){myatu_bgm.addTopImage(\"";
            if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
            if (($_opacity_ < 100)) {
                echo "-moz-opacity:.";
                if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
                echo twig_escape_filter($this->env, $_opacity_, "html", null, true);
                echo ";filter:alpha(opacity=";
                if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
                echo twig_escape_filter($this->env, $_opacity_, "html", null, true);
                echo ");opacity:.";
                if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
                echo twig_escape_filter($this->env, $_opacity_, "html", null, true);
                echo ";";
            }
            echo "\",function(){if((typeof myatu_bgm!==\"undefined\")&&(myatu_bgm.initial_ease_in===\"true\")){a(this).fadeIn(\"slow\")}else{a(this).show()}})}(jQuery))}catch(e){};
    /*]]>*/
    </script>
    <noscript><img id=\"myatu_bgm_top\" class=\"myatu_bgm_fs\" src=\"";
            // line 42
            if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_random_image_, "url"), "html", null, true);
            echo "\" alt=\"";
            if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_random_image_, "alt"), "html", null, true);
            echo "\" ";
            if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
            if (($_opacity_ < 100)) {
                echo "style=\"-moz-opacity:.";
                if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
                echo twig_escape_filter($this->env, $_opacity_, "html", null, true);
                echo "; filter:alpha(opacity=";
                if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
                echo twig_escape_filter($this->env, $_opacity_, "html", null, true);
                echo "); opacity:.";
                if (isset($context["opacity"])) { $_opacity_ = $context["opacity"]; } else { $_opacity_ = null; }
                echo twig_escape_filter($this->env, $_opacity_, "html", null, true);
                echo ";\"";
            }
            echo "  /></noscript>
</div>
";
        }
        // line 45
        echo "

";
        // line 48
        if (isset($context["has_pin_it_btn"])) { $_has_pin_it_btn_ = $context["has_pin_it_btn"]; } else { $_has_pin_it_btn_ = null; }
        if ($_has_pin_it_btn_) {
            // line 49
            echo "<div id=\"myatu_bgm_pin_it_btn\" class=\"myatu_bgm_info_blk\">

<script type=\"text/javascript\">
/*<![CDATA[*/
";
            // line 75
            echo "(function(){window.PinIt=window.PinIt||{loaded:false};if(window.PinIt.loaded){return}window.PinIt.loaded=true;function a(){var c=document.createElement(\"script\"),b=document.getElementsByTagName(\"script\")[0];c.src=\"//assets.pinterest.com/js/pinit.js\";c.type=\"text/javascript\";c.async=true;b.parentNode.insertBefore(c,b)}if(window.attachEvent){window.attachEvent(\"onload\",a)}else{window.addEventListener(\"load\",a,false)}}());
/*]]>*/
</script>
    <a href=\"http://pinterest.com/pin/create/button/?url=";
            // line 78
            if (isset($context["permalink"])) { $_permalink_ = $context["permalink"]; } else { $_permalink_ = null; }
            echo twig_escape_filter($this->env, twig_urlencode_filter($_permalink_), "html", null, true);
            echo "&media=";
            if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
            echo twig_escape_filter($this->env, twig_urlencode_filter($this->getAttribute($_random_image_, "url")), "html", null, true);
            echo "&description=";
            if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
            echo twig_escape_filter($this->env, twig_urlencode_filter(strip_tags($this->getAttribute($_random_image_, "desc"))), "html", null, true);
            echo "\" class=\"pin-it-button\" count-layout=\"none\">Pin It</a>
</div>
";
        }
        // line 81
        echo "

";
        // line 84
        if (isset($context["has_info_tab"])) { $_has_info_tab_ = $context["has_info_tab"]; } else { $_has_info_tab_ = null; }
        if ($_has_info_tab_) {
            // line 85
            echo "<div id=\"myatu_bgm_info\">
    <div id=\"myatu_bgm_info_tab\" class=\"myatu_bgm_info_blk\">
        ";
            // line 87
            if (isset($context["info_tab_link"])) { $_info_tab_link_ = $context["info_tab_link"]; } else { $_info_tab_link_ = null; }
            if ($_info_tab_link_) {
                // line 88
                echo "            <a href=\"";
                if (isset($context["random_image"])) { $_random_image_ = $context["random_image"]; } else { $_random_image_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_random_image_, "link"), "html", null, true);
                echo "\">[ + ]</a>
        ";
            } else {
                // line 90
                echo "            [ + ]
        ";
            }
            // line 92
            echo "    </div>
</div>
";
        }
        // line 95
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 97
        echo "
<!-- Background Manager End -->
";
    }

    public function getTemplateName()
    {
        return "pub_footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 97,  159 => 95,  154 => 92,  150 => 90,  143 => 88,  140 => 87,  136 => 85,  133 => 84,  129 => 81,  116 => 78,  111 => 75,  105 => 49,  102 => 48,  98 => 45,  74 => 42,  55 => 39,  50 => 19,  47 => 18,  44 => 16,  39 => 15,  36 => 13,  28 => 12,  25 => 10,  23 => 9,  19 => 7,);
    }
}
