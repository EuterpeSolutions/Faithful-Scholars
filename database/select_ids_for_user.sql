SELECT f.id as family, h.id as homeschool, mship.id as membership, m.id as membership, s.id as student FROM family as f JOIN homeschool AS h ON f.id = h.family_id JOIN membership AS mship ON f.id = mship.family_id JOIN members AS m ON f.id = m.family_id JOIN student AS s ON f.id = s.family_id WHERE f.id = <INSERT_ID>;