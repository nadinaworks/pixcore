<?php

interface FormRendererInterface
{
    public function render(FormField $form);

    public function setManager(FormManagerInterface $manager);
}