<?php
class AdminFormRenderer implements FormRendererInterface
{
    /**
     * @var FormManagerInterface
     */
    private $manager;

    private $prefix;

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function render(FormField $form)
    {
        switch ($form->getType()) {
            case FormType::MAIN:
                echo "<div class=\"wrap\">";
                    screen_icon();
                    echo '<h2>'. esc_html( get_admin_page_title() ) .'</h2>';
                    echo '<form id="pixcore_form" method="POST" action="'. esc_url( add_query_arg( array( 'page' => 'pixcore' ), admin_url( 'options-general.php' ) ) ) .'">';
                        array_map([$this, 'render'], $form->getChildren());
	                    echo '<button type="submit" name="submitted" value="submitted">Save</button>';
                    echo "</form>";
                echo '</div>';
                break;
            case FormType::GROUP:
                echo "<fieldset class=\"group\">";
	            echo "<h4>". $form->getAttribute('label') ."</h4>";
                array_map([$this, 'render'], $form->getChildren());
                echo "</fieldset>";
                break;
            case FormType::TEXT:
                echo $this->getInput($form);
                break;
            case FormType::CHECKBOX:
                echo $this->getInput($form, 'checkbox');
                break;
        }
    }

    public function setManager(FormManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getName(FormField $form)
    {
        if ($this->prefix != "") {
            return sprintf("%s[%s]", $this->prefix, $form->getName());
        } else {
            return $form->getName();
        }
    }

    public function getInput(FormField $form, $type = 'text')
    {
	    return '<fieldset class="field field-'. $type .'">'.
            "<label>" . $form->getAttribute('label') . "</label><input type='" . $type . "' name='" . $this->getName($form) . "' value='" . $this->manager->get($form->getName(), @$form->getAttributes()['default']) . "'/>".
	        '</fieldset>';
    }


}