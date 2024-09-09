SELECT 
	cursos.nome,
	quizzes.id_quiz,
    perguntas.id_pergunta, 
    perguntas.pergunta, 
    respostas.id_resposta, 
    respostas.resposta, 
    respostas.correta
FROM 
    perguntas 
INNER JOIN 
    respostas 
ON 
    perguntas.id_pergunta = respostas.id_pergunta
INNER JOIN
	quizzes
ON
	quizzes.id_quiz = perguntas.id_quiz
INNER JOIN
	cursos
ON quizzes.id_curso = cursos.id_curso
ORDER BY 
    perguntas.id_pergunta, respostas.id_resposta;
