<?php

class Validate
{
    # Line 171
    /**
     * Extension Parser
     *
     * Takes an associative array of file types and extension, e.g.,
     * $Archives = [
     *   '7z'     => ['7z'],
     *   'bzip2'  => ['bz2', 'bzip2'],
     *   'gzip'   => ['gz', 'gzip', 'tgz', 'tpz'],
     *   ...
     * ];
     *
     * Then it finds all the extensions in a torrent file list,
     * organizes them by file size, and returns the heaviest match.
     *
     * That way, you can have, e.g., 5 GiB FASTQ sequence data in one file,
     * and 100 other small files, and get the format of the actual data.
     *
     * todo: Incorporate into $this->ValidateForm (remove if statements first)
     */
    public function ParseExtensions($FileList, $Category, $FileTypes)
    {
        # Sort $Tor->file_list() output by size
        $UnNested = array_values($FileList[1]);
        $Sorted = (usort($UnNested, function ($a, $b) {
            return $b <=> $a;
        })) ? $UnNested : null;  # Ternary wrap because ↑ returns true

        # Harvest the wheat
        # todo: Entries seem duplicated here
        $Heaviest = array_slice($Sorted, 0, 20);
        $Matches = [];

        # Distill the file format
        $FileTypes = $FileTypes[$Category];
        $FileTypeNames = array_keys($FileTypes);

        foreach ($Heaviest as $Heaviest) {
            # Collect the last 2 period-separated tokens
            $Extensions = array_slice(explode('.', $Heaviest[1]), -2, 2);
            $Matches = array_merge($Extensions);

            # todo: Reduce nesting by one level
            foreach ($Matches as $Match) {
                $Match = strtolower($Match);

		# Construct a comparison array,
		# find the key, and GTFO
                foreach ($FileTypeNames as $FileTypeName) {
                    $SearchMe = [ $FileTypeName, $FileTypes[$FileTypeName] ];
        
                    if (in_array($Match, $SearchMe[1])) {
                        return $SearchMe[0];
                        break;
                    }
                }

                # Return the last element (Other or None)
                return array_key_last($FileTypes);
            }
        }
    }
    # Line 229
