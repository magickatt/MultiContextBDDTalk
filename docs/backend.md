Because I ran out of time to parse the headings in each text file, here is the quickest way to re-populate the ID's in the locations table if necessary.

    INSERT INTO locations (id) SELECT DISTINCT location FROM entries;