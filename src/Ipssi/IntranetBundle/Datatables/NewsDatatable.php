<?php

namespace Ipssi\IntranetBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class NewsDatatable
 *
 * @package Ipssi\IntranetBundle\Datatables
 */
class NewsDatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('intranet_news_create'),
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
//                'buttons' =>
//                    array(
//                        'colvis',
//                        'excel',
//                        'pdf' => array(
//                            'extend' => 'pdf',
//                            'exportOptions' => array(
//                                // show only the following columns:
//                                'columns' => array(
//                                    '0', // title column
//                                    '1', // title column
//                                    '2', // title column
//                                    '3', // visible column
//                                    '4', // visible column
//                                    '5', // publishedAt column
//                                    '6', // updatedAt column
//                                    '7', // createdBy column
//                                )
//                            )
//                        ),
//                    ),
                'responsive' => true,
                'fixedHeader' => true,
            ),
            'highlight' => true,
            'highlight_color' => 'yellow'
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('intranet_news_results'),
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
            ->add('name', 'column', array(
                'title' => 'Name',
            ))
            ->add('creationDate', 'datetime', array(
                'title' => 'CreationDate',
            ))
//            ->add('modificationDate', 'datetime', array(
//                'title' => 'ModificationDate',
//            ))
            ->add('title', 'column', array(
                'title' => 'Title',
            ))
//            ->add('resume', 'column', array(
//                'title' => 'Resume',
//            ))
//            ->add('content', 'column', array(
//                'title' => 'Content',
//            ))
            ->add('slug', 'column', array(
                'title' => 'Slug',
            ))
            ->add('status', 'column', array(
                'title' => 'Status',
            ))
//            ->add('metaDescription', 'column', array(
//                'title' => 'MetaDescription',
//            ))
//            ->add('metaTitle', 'column', array(
//                'title' => 'MetaTitle',
//            ))
            ->add('user.username', 'column', array(
                'title' => 'Utilisateur',
            ))
//            ->add('user.google_id', 'column', array(
//                'title' => 'User Google_id',
//            ))
//            ->add('user.google_access_token', 'column', array(
//                'title' => 'User Google_access_token',
//            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'intranet_news_view',
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
                        'route' => 'intranet_news_update',
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
                        'route' => 'intranet_news_delete',
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
        return 'Ipssi\IntranetBundle\Entity\News';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'news_datatable';
    }
}
