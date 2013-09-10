<?php

interface PixCoreFormRendererInterface
{
    public function render(PixCoreFormField $form);

    public function setManager(PixCoreFormManagerInterface $manager);
}