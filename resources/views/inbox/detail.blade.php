@extends('layouts.app')

@section('page-title', 'Detail Inbox')

@section('content-main')
<div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Detail Pesan Masuk</h3>

              <div class="card-tools">
                <a href="{{ route('inbox.index') }}" class="btn btn-tool" title="Kembali"><i class="fas fa-chevron-left"></i></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>{{ $inbox->inbox_perihal }}</h5>
                <h6>From: {{ $inbox->inbox_nama }} ({{ $inbox->inbox_whatsapp }})
                  <span class="mailbox-read-time float-right">{{ $inbox->created_at->format('d M Y H:i') }}</span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>{{ $inbox->inbox_isi }}</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>
            <!-- /.card-footer -->
          </div>
          @endsection
