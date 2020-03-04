## Detect and autofill file types by extension

One of the challenges of tracking biology data is the overwhelming number of file formats.
If a user leaves the container or archive dropdown blank, this tool
  * sorts the torrent file list by size,
  * tokenizes the file name and grabs the last two extensions, and
  * returns the first matching extension key.

Sometimes a match isn't found.
As a fallback, the function assigns the last key.
Please take care to use an Other entry last as shown below, or return something else.
By the way, it can be adapted to autofill any cumbersome metadata with a set of expected values and a different set of common names.

## In this repo
Please find all the snippets you need to implement a similar feature on your own tracker.
See `classes/config.php` for an idea of how the each format is associated with an array of file extensions.
I'll reproduce an example below so you can see how powerful a general extension parser can be.

```php
$ContainersExtra = [
  'Docker'           => ['dockerfile'],
  'Hard Disk'        => ['fvd', 'dmg', 'esd', 'qcow', 'qcow2', 'qcow3', 'smi', 'swm', 'vdi', 'vhd', 'vhdx', 'vmdk', 'wim'],
  'Optical Disc'     => ['bin', 'ccd', 'cso', 'cue', 'daa', 'isz', 'mdf', 'mds', 'mdx', 'nrg', 'uif'],
  'Python'           => ['pxd', 'py', 'py3', 'pyc', 'pyd', 'pyde', 'pyi', 'pyo', 'pyp', 'pyt', 'pyw', 'pywz', 'pyx', 'pyz', 'rpy', 'xpy'],
  'Jupyter Notebook' => ['ipynb'],
  'Ontology'         => ['cgif', 'cl', 'clif', 'htm', 'html', 'kif', 'obo', 'owl', 'rdf', 'rdfa', 'rdfs', 'rif', 'tsv', 'xcl', 'xht', 'xhtml', 'xml'],
  'OpenDocument'     => ['odt', 'fodt', 'ods', 'fods', 'odp', 'fodp', 'odg', 'fodg', 'odf'],
  'Word'             => ['doc', 'dot', 'wbk', 'docx', 'docm', 'dotx', 'dotm', 'docb'],
  'Excel'            => ['xls', 'xlt', 'xlm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xla', 'xlam', 'xll', 'xlw'],
  'PowerPoint'       => ['ppt', 'pot', 'pps', 'pptx', 'pptm', 'potx', 'potm', 'ppam', 'ppsx', 'ppsm', 'sldx', 'sldm'],
  'PDF'              => ['pdf', 'fdf', 'xfdf'],
  'Plain'            => ['csv', 'txt'],
  'Other'            => [''],
];
```

## Caveats and todos
Test thoroughly before implementing to ensure the behavior is what you expect!
You don't want to ruin the database with unexpected "Autofill" formats.

For this reason, extension parsing is disabled on the torrent edit handler for now.
The FileList stored in the database, available to the edit form, is a bencoded string instead of a nested array.
`$Validate->ParseExtensions` currently only works with the `$Tor->FileList` object before it's bencoded.

Also, file extensions shared by multiple formats can't be parsed, e.g., there's no way to tell what kind of image an IMG file is.
It could be a hard disk or an optical disc.
That's all for now.
