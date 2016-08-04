{
   "type":"message/card.receipt",
   "attachments":[
      {
         "contentType":"application/vnd.microsoft.card.receipt",
         "content":{
            "title" : '{!! trans('texts.invoice_for_client', [
                'invoice' => link_to($invoice->getRoute(), $invoice->invoice_number),
                'client' => link_to($invoice->client->getRoute(), $invoice->client->getDisplayName())
            ]) !!}',
            "items":[
                @foreach ($invoice->invoice_items as $item)
                    @if ($invoice->invoice_items[0] != $item)
                        ,
                    @endif
                    {
                      "title":"{{ $item->product_key }}",
                      "subtitle":"{{ $item->notes }}",
                      "price":"{{ $item->cost }}",
                      "quantity":"{{ $item->qty }}"
                    }
                @endforeach
            ],
            @if (false)
                "tax":"0.00",
            @endif
            "total":"{{ $invoice->present()->amount }}",
            "buttons":[
                {
                   "type":"imBack",
                   "title":"{{ trans('texts.send_email') }}",
                   "value":"send_email"
                },
                {
                   "type":"imBack",
                   "title":"{{ trans('texts.download_pdf') }}",
                   "value":"download_pdf"
                }
            ]
         }
      }
   ]
}
