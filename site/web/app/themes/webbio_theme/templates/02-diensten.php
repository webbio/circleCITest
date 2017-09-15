<?php

/*
 Template Name: 02-diensten
 */

$context = Timber::get_context();
$context['post'] = Timber::get_post();



$id_page = get_the_ID();
$method = array(
  array(
    "title"   => get_field('werkwijze_blok_1_titel', $id_page),
    "content" => get_field('werkwijze_blok_1_tekst', $id_page),
  ),
  array(
    "title"   => get_field('werkwijze_blok_2_titel', $id_page),
    "content" => get_field('werkwijze_blok_2_tekst', $id_page),
  ),
  array(
    "title"   => get_field('werkwijze_blok_3_titel', $id_page),
    "content" => get_field('werkwijze_blok_3_tekst', $id_page),
  ),
  array(
    "title"   => get_field('werkwijze_blok_4_titel', $id_page),
    "content" => get_field('werkwijze_blok_4_tekst', $id_page),
  )
);

$diensten = array(
  array(
    "icon"    => get_field('diensten_icoon_blok_1', $id_page),
    "title"   => get_field('diensten_titel_blok_1', $id_page),
    "content" => get_field('diensten_tekst_blok_1', $id_page),
    "diensten"=> get_field('diensten_geselecteerde_diensten_blok_1', $id_page),
  ),
  array(
    "icon"    => get_field('diensten_icoon_blok_2', $id_page),
    "title"   => get_field('diensten_titel_blok_2', $id_page),
    "content" => get_field('diensten_tekst_blok_2', $id_page),
    "diensten"=> get_field('diensten_geselecteerde_diensten_blok_2', $id_page),
  ),
  array(
    "icon"    => get_field('diensten_icoon_blok_3', $id_page),
    "title"   => get_field('diensten_titel_blok_3', $id_page),
    "content" => get_field('diensten_tekst_blok_3', $id_page),
    "diensten"=> get_field('diensten_geselecteerde_diensten_blok_3', $id_page),
  ),
);

$context['method'] = $method;
$context['diensten_item'] = $diensten;
echo Timber::compile('views/pages/02-diensten.twig', $context);

?>