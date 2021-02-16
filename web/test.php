<?php

echo pg_unescape_bytea(pg_escape_bytea("STRIN\\\\G"));