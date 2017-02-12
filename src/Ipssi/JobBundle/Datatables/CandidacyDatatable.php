<?php

namespace Ipssi\JobBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class PageDatatable
 *
 * @package Ipssi\IntranetBundle\Datatables
 */
class CandidacyDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array(), $offer = null)
    {
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
//                array(
//                    'route' => $this->router->generate('intranet_page_create'),
//                    'label' => $this->translator->trans('datatables.actions.new'),
//                    'icon' => 'glyphicon glyphicon-plus',
//                    'attributes' => array(
//                        'rel' => 'tooltip',
//                        'title' => $this->translator->trans('datatables.actions.new'),
//                        'class' => 'btn btn-primary',
//                        'role' => 'button'
//                    ),
//                )
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

        if($offer)
        {
            $this->ajax->set(array(
                'url' => $this->router->generate('intranet_candidacy_offer_results', array('offer' => $offer)),
                'type' => 'POST',
                'pipeline' => 0
            ));
        } else {
            $this->ajax->set(array(
                'url' => $this->router->generate('intranet_candidacy_results'),
                'type' => 'POST',
                'pipeline' => 0
            ));
        }



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
            ->add('offer.name', 'column', array(
                'title' => 'Offre',
            ))
            ->add('createdAt', 'datetime', array(
                'title' => 'Créé le',
            ))
            ->add('candidate.username', 'column', array(
                'title' => 'Candidat',
            ))
            ->add('cv.cvName', 'column', array(
                'title' => 'CV',
            ))
            ->add('status', 'column', array(
                'title' => 'Statut',
            ))
            ->add('updatedAt', 'datetime', array(
                'title' => 'Modifiée le',
            ))
            ->add('updatedBy.username', 'column', array(
                'title' => 'Modifié par',
            ))

            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'intranet_candidacy',
                        'route_parameters' => array(
                            'candidacy' => 'id'
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
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Ipssi\JobBundle\Entity\Candidacy';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'candidacy_datatable';
    }
}
