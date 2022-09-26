select c1.name AS team1 , c2.name AS team2, score_a, score_b 
from matches m 
inner join countries c1 on m.id_team_a = c1.id 
inner join countries c2 on m.id_team_b = c2.id