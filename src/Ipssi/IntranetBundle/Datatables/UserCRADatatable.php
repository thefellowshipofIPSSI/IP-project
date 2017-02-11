<?php

namespace Ipssi\IntranetBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class UserCRADatatable
 *
 * @package Ipssi\IntranetBundle\Datatables
 */
class UserCRADatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('intranet_cra_create'),
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
            'url' => $this->router->generate('intranet_cra_results'),
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
                'title' => 'Ref',
            ))
            ->add('creationDate', 'datetime', array(
                'title' => 'Création',
            ))
//            ->add('modificationDate', 'datetime', array(
//                'title' => 'ModificationDate',
//            ))
            ->add('projectName', 'column', array(
                'title' => 'Projet',
            ))
            ->add('client', 'column', array(
                'title' => 'Client',
            ))
//            ->add('activityReport', 'column', array(
//                'title' => 'ActivityReport',
//            ))
            ->add('beginDate', 'datetime', array(
                'title' => 'Début',
            ))
            ->add('endDate', 'datetime', array(
                'title' => 'Fin',
            ))
//            ->add('nbLostTimeAccident', 'column', array(
//                'title' => 'NbLostTimeAccident',
//            ))
//            ->add('nbNoneLostTimeAccident', 'column', array(
//                'title' => 'NbNoneLostTimeAccident',
//            ))
//            ->add('nbTravelAccident', 'column', array(
//                'title' => 'NbTravelAccident',
//            ))
//            ->add('nbSickDay', 'column', array(
//                'title' => 'NbSickDay',
//            ))
//            ->add('nbVacancyDay', 'column', array(
//                'title' => 'NbVacancyDay',
//            ))
//            ->add('clientSatisfaction', 'column', array(
//                'title' => 'ClientSatisfaction',
//            ))
//            ->add('consultantSatisfaction', 'column', array(
//                'title' => 'ConsultantSatisfaction',
//            ))
//            ->add('ameliorationPoint', 'column', array(
//                'title' => 'AmeliorationPoint',
//            ))
//            ->add('leftActivity', 'column', array(
//                'title' => 'LeftActivity',
//            ))
//            ->add('comments', 'column', array(
//                'title' => 'Comments',
//            ))
//            ->add('client_validation', 'column', array(
//                'title' => 'Client_validation',
//            ))
//            ->add('client_validation_date', 'datetime', array(
//                'title' => 'Client_validation_date',
//            ))
            ->add('user.username', 'column', array(
                'title' => 'Utilisateur',
                'add_if' => function() {
                    return $this->authorizationChecker->isGranted('ROLE_EDIT_CRA');
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
            ->add('statut.name', 'column', array(
                'title' => 'Statut',
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'intranet_cra_view',
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
                        'route' => 'intranet_cra_update',
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
                        'route' => 'intranet_cra_delete',
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
        return 'Ipssi\IntranetBundle\Entity\UserCRA';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'usercra_datatable';
    }
}
