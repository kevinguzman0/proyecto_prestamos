@extends('errors.minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __('User does not have the right roles.') ?: 'Forbidden'))
