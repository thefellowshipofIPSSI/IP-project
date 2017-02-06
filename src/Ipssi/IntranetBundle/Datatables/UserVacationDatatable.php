<?php

namespace Ipssi\IntranetBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class UserVacationDatatable
 *
 * @package Ipssi\IntranetBundle\Datatables
 */
class UserVacationDatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('intranet_vacation_create'),
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
            'url' => $this->router->generate('intranet_vacation_results'),
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
            ->add('creationDate', 'datetime', array(
                'title' => 'Création',
            ))
//            ->add('modificationDate', 'datetime', array(
//                'title' => 'ModificationDate',
//            ))
            ->add('beginDate', 'datetime', array(
                'title' => 'Début',
            ))
            ->add('endDate', 'datetime', array(
                'title' => 'Fin',
            ))
            ->add('nbDays', 'column', array(
                'title' => 'Nombre de J',
            ))
//            ->add('comment', 'column', array(
//                'title' => 'Comment',
//            ))
            ->add('status', 'column', array(
                'title' => 'StatuT',
            ))
            ->add('user.username', 'column', array(
                'title' => 'Utilisateur',
                'add_if' => function() {
                    return $this->authorizationChecker->isGranted('ROLE_ADMIN');
                },
            ))
//            ->add('user.google_id', 'column', array(
//                'title' => 'User Google_id',
//            ))
//            ->add('user.google_access_token', 'column', array(
//                'title' => 'User Google_access_token',
//            ))
//            ->add('user_validation.id', 'column', array(
//                'title' => 'User_validation Id',
//            ))
//            ->add('user_validation.google_id', 'column', array(
//                'title' => 'User_validation Google_id',
//            ))
//            ->add('user_validation.google_access_token', 'column', array(
//                'title' => 'User_validation Google_access_token',
//            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'intranet_vacation_view',
                        'route_parameters' => array(
                            'id' => 'id'
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
                        'route' => 'intranet_vacation_update',
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
                        'route' => 'intranet_vacation_delete',
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
        return 'Ipssi\IntranetBundle\Entity\UserVacation';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'uservacation_datatable';
    }
}
