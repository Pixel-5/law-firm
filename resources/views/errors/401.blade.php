@extends('errors::custom-error')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('System Access denied'))
