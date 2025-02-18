<?php
return [
  'custom' => [
      'url' => [
         'required' => 'Enter url input to get short link.',
          'regex' => 'Provided link is incorrect.',
          'unique' => 'Provided link is already taken.'
      ],
      'short_id' => [
          'unique' => 'Provided short link is already taken.'
      ]
  ]
];
