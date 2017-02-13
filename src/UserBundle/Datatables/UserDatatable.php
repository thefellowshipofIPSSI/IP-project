<?php

namespace UserBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class UserDatatable
 *
 * @package UserBundle\Datatables
 */
class UserDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('intranet_user_create'),
                    'label' => $this->translator->trans('datatables.actions.new'),
                    'icon' => 'glyphicon glyphicon-plus',
                    'attributes' => array(
                        'rel' => 'tooltip',
                        'title' => $this->translator->trans('datatables.actions.new'),
                        'class' => 'btn btn-primary',
                        'role' => 'button'
                    ),
                )
            )
        ));

        $this->features->set(array(
            'auto_width' => true,
            'defer_render' => false,
            'info' => true,
            'jquery_ui' => false,
            'length_change' => true,
            'ordering' => true,
            'paging' => true,
            'processing' => true,
            'searching' => true,
            'state_save' => false,
            'delay' => 0,
            'scroll_y' => '',
            'scroll_x' => false,
            'extensions' => array(
                'buttons' =>
                    array(
                        'colvis',
                        'excel',
                        'pdf' => array(
                            'extend' => 'pdf',
                            'exportOptions' => array(
                                // show only the following columns:
                                'columns' => array(
                                    '0', // title column
                                    '1', // title column
                                    '2', // title column
                                    '3', // visible column
                                    '4', // visible column
                                    '5', // publishedAt column
                                    '6', // updatedAt column
                                    '7', // createdBy column
                                )
                            )
                        ),
                    ),
                'responsive' => true,
                'fixedHeader' => true,
            ),
            'highlight' => true,
            'highlight_color' => 'yellow'
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('intranet_user_results'),
            'type' => 'POST',
            'pipeline' => 0
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => 'lfrtip',
            'length_menu' => array(5, 10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => false,
            'row_id' => 'id'
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
            ))
            ->add('email', 'column', array(
                'title' => 'Email',
            ))
//            ->add('google_id', 'column', array(
//                'title' => 'Google_id',
//            ))
//            ->add('google_access_token', 'column', array(
//                'title' => 'Google_access_token',
//            ))
//            ->add('profile.id', 'column', array(
//                'title' => 'Profile Id',
//            ))
            ->add('profile.pseudo', 'column', array(
                'title' => 'Pseudo',
            ))
//            ->add('profile.gravatar', 'column', array(
//                'title' => 'Profile Gravatar',
//            ))
            ->add('profile.firstname', 'column', array(
                'title' => 'Prénom',
            ))
            ->add('profile.lastname', 'column', array(
                'title' => 'Nom',
            ))
//            ->add('groups.name', 'column', array(
//                'title' => 'Groupe',
//            ))
//            ->add('profile.phone', 'column', array(
//                'title' => 'Profile Phone',
//            ))
//            ->add('profile.address', 'column', array(
//                'title' => 'Profile Address',
//            ))
//            ->add('profile.zipcode', 'column', array(
//                'title' => 'Profile Zipcode',
//            ))
//            ->add('profile.city', 'column', array(
//                'title' => 'Profile City',
//            ))
//            ->add('profile.country', 'column', array(
//                'title' => 'Profile Country',
//            ))
//            ->add('profile.birthDate', 'column', array(
//                'title' => 'Profile BirthDate',
//            ))
//            ->add('profile.other', 'column', array(
//                'title' => 'Profile Other',
//            ))
//            ->add('newsletter.id', 'column', array(
//                'title' => 'Newsletter Id',
//            ))
//            ->add('newsletter.email', 'column', array(
//                'title' => 'Newsletter Email',
//            ))
//            ->add('newsletter.enabled', 'column', array(
//                'title' => 'Newsletter Enabled',
//            ))
//            ->add('newsletter.createdAt', 'column', array(
//                'title' => 'Newsletter CreatedAt',
//            ))
//            ->add('newsletter.updatedAt', 'column', array(
//                'title' => 'Newsletter UpdatedAt',
//            ))
//            ->add('society.id', 'column', array(
//                'title' => 'Society Id',
//            ))
//            ->add('society.name', 'column', array(
//                'title' => 'Society Name',
//            ))
//            ->add('society.address', 'column', array(
//                'title' => 'Society Address',
//            ))
//            ->add('society.zipcode', 'column', array(
//                'title' => 'Society Zipcode',
//            ))
//            ->add('society.city', 'column', array(
//                'title' => 'Society City',
//            ))
//            ->add('society.email', 'column', array(
//                'title' => 'Society Email',
//            ))
//            ->add('society.primaryPhone', 'column', array(
//                'title' => 'Society PrimaryPhone',
//            ))
//            ->add('society.secondaryPhone', 'column', array(
//                'title' => 'Society SecondaryPhone',
//            ))
//            ->add('society.country', 'column', array(
//                'title' => 'Society Country',
//            ))
//            ->add('society.presentation', 'column', array(
//                'title' => 'Society Presentation',
//            ))
//            ->add('society.createdAt', 'column', array(
//                'title' => 'Society CreatedAt',
//            ))
//            ->add('society.updatedAt', 'column', array(
//                'title' => 'Society UpdatedAt',
//            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'user_profile_public',
                        'route_parameters' => array(
                            'pseudo' => 'profile.pseudo'
                        ),
                        'label' => '',
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'intranet_user_update',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => '',
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'intranet_user_delete',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => '',
                        'icon' => 'glyphicon glyphicon-trash',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.delete'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'UserBundle\Entity\User';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_datatable';
    }
}
