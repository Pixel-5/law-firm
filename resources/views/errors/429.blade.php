@extends('errors::custom-error')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
