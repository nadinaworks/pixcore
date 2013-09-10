<?php return array
	(
		'template-paths' => array
			(
				dirname(__FILE__).DIRECTORY_SEPARATOR.'sample-templates'
			),

		'fields' => array
			(

				'example_item' => array
					(
						'label' => 'Example Label',
						'desc' => 'Example field description goes here.',
						'default' => 'Projects',
						'type' => 'text',

						'attrs' => array
							(
								'disable' => false,
							),
					),

				'example_item_two' => array
					(
						'label' => 'Example color field',
						'desc' => 'Example color field description.',
						'default' => 'Projects',
						'type' => 'color',

						'attrs' => array
							(
								'disable' => false,
							),
					),

				'portfolio_single_item' => array
					(
						'label' => 'Multiple Items Label',
						'desc' => 'Here you can change the singular label. The default is "Project"',
						'default' => 'Project',
						'type' => 'text',

						'attrs' => array
							(
								'disable' => false,
							),
					),

			),

	); # config
