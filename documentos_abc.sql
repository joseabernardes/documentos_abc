-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jul-2017 às 10:10
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `documentos_abc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `address`
--

CREATE TABLE `address` (
  `AddressID` int(11) NOT NULL,
  `AddressCOUNTRY` varchar(30) NOT NULL,
  `AddressCITY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `address`
--

INSERT INTO `address` (`AddressID`, `AddressCOUNTRY`, `AddressCITY`) VALUES
(4, 'Portugal', 'Porto'),
(5, 'Portugal', 'Castelo de Paiva'),
(6, 'Portugal', 'Castelo de Paiva'),
(7, 'Portugal', 'Paredes'),
(8, 'Portugal', 'SÃO MARTINHO DE SARDOURA'),
(9, 'Portugal', 'DASDASD'),
(10, 'Portugal', 'fELG'),
(11, 'Portugal', 'asd'),
(12, 'asd', 'SÃd'),
(19, 'oo', 'oo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alert`
--

CREATE TABLE `alert` (
  `AlertID` int(11) NOT NULL,
  `AlertUserID` int(11) NOT NULL,
  `AlertUserSendID` int(11) NOT NULL,
  `AlertDocumentID` int(11) DEFAULT NULL,
  `AlertDATE` datetime NOT NULL,
  `AlertTYPE` enum('SHARE','NOSHARE','DELETE') NOT NULL,
  `AlertDocumentNAME` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryNAME`) VALUES
(1, 'Livre'),
(3, 'Ciências'),
(4, 'Biologia'),
(23, 'Gest&atilde;o'),
(24, 'Matem&aacute;tica'),
(25, 'Filosofia'),
(28, 'Programa&ccedil;&atilde;o');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `CommentCONTENT` longtext NOT NULL,
  `CommentDATE` datetime NOT NULL,
  `CommentDocumentID` int(11) NOT NULL,
  `CommentNAME` varchar(100) DEFAULT NULL,
  `CommentEMAIL` varchar(50) DEFAULT NULL,
  `CommentUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comment`
--

INSERT INTO `comment` (`CommentID`, `CommentCONTENT`, `CommentDATE`, `CommentDocumentID`, `CommentNAME`, `CommentEMAIL`, `CommentUserID`) VALUES
(72, '&Eacute; fixe o livro?', '2017-06-21 01:43:34', 27, 'Joel', NULL, 14),
(73, 'Eu li e adorei!', '2017-06-21 01:44:13', 27, 'José Bernardes', NULL, 11),
(74, 'Ho, que simp&aacute;tico.-.', '2017-06-21 01:49:34', 27, 'Joel', NULL, 14),
(94, '123123123123', '2017-06-28 11:04:16', 28, 'abc', NULL, 26),
(95, 'asdddd', '2017-06-28 11:04:38', 28, 'abc', NULL, 26),
(96, '11', '2017-06-28 11:04:42', 28, 'abc', NULL, 26),
(97, '123123123123', '2017-06-28 11:05:23', 28, 'abc', NULL, 26),
(98, '123123123123', '2017-06-28 11:09:53', 27, 'Joel Pereira Ribeiro', NULL, 14),
(99, '123123123123', '2017-06-28 11:10:02', 27, 'Joel Pereira Ribeiro', NULL, 14),
(100, '123123123123', '2017-06-28 11:10:13', 28, 'Joel Pereira Ribeiro', NULL, 14),
(101, '123123123123', '2017-06-28 11:10:49', 28, 'Joel Pereira Ribeiro', NULL, 14),
(102, 'Adoro fazer coment&aacute;rios!', '2017-07-03 14:20:28', 27, 'Joel Pereira Ribeiro', NULL, 14),
(103, 'sss', '2017-07-03 14:29:57', 27, 'Joel Pereira Ribeiro', NULL, 14),
(104, 'v', '2017-07-03 17:24:00', 28, 'José Bernardes', NULL, 11),
(105, 'aaa', '2017-07-03 17:24:34', 28, 'José Bernardes', NULL, 11),
(106, 'eqwe', '2017-07-03 17:38:59', 27, 'qwe', 'alberto@alberto.com', NULL),
(107, '123123123123', '2017-07-05 12:04:44', 10, 'Joel Pereira Ribeiro', NULL, 14),
(108, '123123123123', '2017-07-05 12:04:50', 10, 'Joel Pereira Ribeiro', NULL, 14),
(109, '123123123123', '2017-07-05 12:04:51', 10, 'Joel Pereira Ribeiro', NULL, 14),
(110, '123123123123', '2017-07-05 12:04:51', 10, 'Joel Pereira Ribeiro', NULL, 14),
(111, '123123123123', '2017-07-05 12:04:51', 10, 'Joel Pereira Ribeiro', NULL, 14),
(112, '123123123123', '2017-07-05 12:04:52', 10, 'Joel Pereira Ribeiro', NULL, 14),
(113, '123123123123', '2017-07-05 12:04:52', 10, 'Joel Pereira Ribeiro', NULL, 14),
(114, '123123123123', '2017-07-05 12:04:53', 10, 'Joel Pereira Ribeiro', NULL, 14),
(115, '123123123123', '2017-07-05 12:04:53', 10, 'Joel Pereira Ribeiro', NULL, 14),
(116, '123123123123', '2017-07-05 12:04:54', 10, 'Joel Pereira Ribeiro', NULL, 14),
(117, '123123123123', '2017-07-05 12:04:54', 10, 'Joel Pereira Ribeiro', NULL, 14),
(118, '123123123123', '2017-07-05 12:04:55', 10, 'Joel Pereira Ribeiro', NULL, 14),
(119, '123123123123', '2017-07-05 12:04:55', 10, 'Joel Pereira Ribeiro', NULL, 14),
(120, '123123123123', '2017-07-05 12:04:55', 10, 'Joel Pereira Ribeiro', NULL, 14),
(121, '123123123123', '2017-07-05 12:04:56', 10, 'Joel Pereira Ribeiro', NULL, 14),
(122, '123123123123', '2017-07-05 12:04:56', 10, 'Joel Pereira Ribeiro', NULL, 14),
(123, '123123123123', '2017-07-05 12:04:56', 10, 'Joel Pereira Ribeiro', NULL, 14),
(124, '123123123123', '2017-07-05 12:04:57', 10, 'Joel Pereira Ribeiro', NULL, 14),
(125, '123123123123', '2017-07-05 12:04:57', 10, 'Joel Pereira Ribeiro', NULL, 14),
(126, '123123123123', '2017-07-05 12:04:57', 10, 'Joel Pereira Ribeiro', NULL, 14),
(127, '123123123123', '2017-07-05 12:05:03', 10, 'Joel Pereira Ribeiro', NULL, 14),
(128, '123123123123', '2017-07-05 12:05:07', 10, 'Joel Pereira Ribeiro', NULL, 14),
(129, 'qwr', '2017-07-05 17:55:57', 28, 'José Bernardes', NULL, 11),
(130, 'dfghjkl&ccedil;', '2017-07-05 17:57:15', 28, 'José Bernardes', NULL, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `document`
--

CREATE TABLE `document` (
  `DocumentID` int(11) NOT NULL,
  `DocumentTITLE` varchar(90) NOT NULL,
  `DocumentUserID` int(11) NOT NULL,
  `DocumentSUMMARY` varchar(200) NOT NULL,
  `DocumentCategoryID` int(11) NOT NULL,
  `DocumentDATE` datetime NOT NULL,
  `DocumentCONTENT` longtext NOT NULL,
  `DocumentPATH` varchar(200) DEFAULT NULL,
  `DocumentVisibilityID` int(11) NOT NULL,
  `DocumentCOMMENTS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `document`
--

INSERT INTO `document` (`DocumentID`, `DocumentTITLE`, `DocumentUserID`, `DocumentSUMMARY`, `DocumentCategoryID`, `DocumentDATE`, `DocumentCONTENT`, `DocumentPATH`, `DocumentVisibilityID`, `DocumentCOMMENTS`) VALUES
(10, 'Enunciado PAW', 11, 'A empresa Documentos ABC pretende criar uma plataforma simples de gestão documental.?', 1, '2017-06-14 10:39:19', 'Considerações gerais do trabalho&#13;&#10;A realização do trabalho prático da disciplina de Programação em Ambiente Web pressupõe o desenvolvimento de&#13;&#10;um website de disponibilização e edição de documentos de texto, mais especificamente no formato “.doc”.&#13;&#10;O trabalho deverá ser desenvolvido obrigatoriamente em grupos de 2 elementos, devendo o grupo ser formado&#13;&#10;através da plataforma Moodle até ao dia 26 de maio às 23:55 (hora Moodle).&#13;&#10;Para trabalhos de grupos com dimensão diferente, o(s) aluno(s) deve(m) atempadamente manifestar a intenção de o&#13;&#10;fazer, ficando a equipa docente da unidade curricular de apreciar o pedido.&#13;&#10;A deteção de trabalhos fraudulentos invalida a nota de todos os grupos de todos os trabalhos envolvidos. Serão&#13;&#10;considerados trabalhos fraudulentos, aqueles onde se verifique trabalho desenvolvido por pessoas que não façam parte&#13;&#10;do grupo, na totalidade do trabalho ou apenas em parte deste.&#13;&#10;Todo o código do Trabalho Prático deve ser da autoria do(s) elemento(s) do grupo, ou obtido através de recursos&#13;&#10;disponibilizados na plataforma Moodle. Caso o grupo pretenda utilizar código que não seja da sua autoria terá que,&#13;&#10;atempadamente, solicitar autorização à equipa docente até ao dia 18 de junho.&#13;&#10;Prazos&#13;&#10;A data limite de entrega do trabalho prático (obrigatória) é no dia 21 de junho pelas 09:00 (hora Moodle). Todos os&#13;&#10;elementos do grupo devem entregar o trabalho. A entrega deverá ser efetuada através da plataforma Moodle em local&#13;&#10;apropriado, sendo composta por três componentes:&#13;&#10;1) Website (composto pela base de dados, código fonte e outros);&#13;&#10;2) Relatório em formato digital / Manual de instalação e configuração do site.&#13;&#10;Todas as componentes deverão ser entregues num ficheiro ZIP, com o seguinte nome: paw_EpN_GXX.zip (onde XX&#13;&#10;deverá ser substituído pelo numero do grupo). O relatório deverá ser entregue em formato .PDF. Em caso de corrupção&#13;&#10;de alguma componente, o trabalho é considerado como não entregue.&#13;&#10;Os trabalhos entregues fora de prazo não serão considerados.', NULL, 1, 1),
(26, 'Netbeans', 11, 'O NetBeans IDE é um ambiente de desenvolvimento integrado', 28, '2017-06-20 16:17:50', 'O NetBeans IDE é um ambiente de desenvolvimento integrado gratuito e de código aberto para desenvolvedores de software nas linguagens Java, C, C++, PHP, Groovy, Ruby, entre outras. O IDE é executado em muitas plataformas, como Windows, Linux, Solaris e MacOS.', NULL, 2, 0),
(27, 'Os crimes do ABC', 14, 'Os crimes do ABC é um livro', 23, '2017-06-21 01:42:45', 'Os crimes do ABC&#13;&#10; Agatha ChristieNasceu em Inglaterra no dia 15 de setembro de 1890.&#13;&#10;Foi uma romanista policial britânica.&#13;&#10;Escreveu mais de oitenta livros sendo sessenta e seis do género romance policial e inúmeros contos.&#13;&#10;Foi considerada como “duquesa da morte”, “rainha do crime”&#13;&#10;É uma das autoras mais traduzidas de sempre w criou varias personagens tais como “Poirot”, “Marple”,”Tommy” entre outros.&#13;&#10;Morreu no dia 12 de Jneiro de 1976.&#13;&#10;Resumo&#13;&#10;O livro é narrado pelo capitão Hastings, eterno companheiro do Hercule Poirot, um detetive particular belga .Tudo tem início com uma visita de Hastings a Londres, onde ele decide procurar seu amigo Poirot.&#13;&#10;Nessa visita Poirot acaba então mostrando a Hastings um envelope que recebeu recentemente. &#13;&#10;Nesse envelope há uma carta para Poirot onde uma pessoa que assina por ABC, avisa que se ele realmente aprecia um bom mistério deve ficar atento aos acontecimentos que irão ocorrer na cidade de Andover no dia 21.&#13;&#10;Apesar de Hastings acreditar que seja apenas uma carta de um louco, Poirot se mostra preocupado e curioso.&#13;&#10;A primeira vitima do ABC é a Sra. Ascher, dona de uma pequena tabacaria em Andover. O crime aconteceu no dia 21, assim como foi alertado na carta que Poirot recebeu. E na cena do crime, próximo a vitima, os detetives encontraram um guia ferroviário ABC, com a cidade de Andover marcada. E assim foi o início de tudo.&#13;&#10;Poirot tem certeza de que foi o autor da carta o responsável pelo crime .Até que um mês depois, Poirot recebe outra carta misterioso &#34;Abc na carta ABC diz a Poirot que observe Bexhill-on-Sea, no dia 25 daquele mês.&#13;&#10;E o crime acontece. Betty Barnard é encontrada morta na praia e em baixo de seu corpo, um guia ABC aberto na página dos trens para Bexhill.  E novamente a polícia tem um suspeito, mas as investigações não dão em nada. Fica decidido então que assim que chegar a próxima carta anunciando a cidade onde ocorrerá o próximo crime, eles irão a público alertar as possíveis vítimas. Mas por um acaso, a carta chega até Poirot no mesmo dia em que o crime será cometido. ABC vai matando as pessoas em ordem alfabética, o nome e o sobrenome da pessoa, tem que começar com determinada letra e o lugar em que ela foi assassinada também.&#13;&#10; A cidade escolhida é Churston.  &#13;&#10;Depois de muita investigação por parte da policia e de Poirot, os familiares das 3 vítimas decidem então se juntar a Poirot e ajudar na investigação, afim de evitar uma quarta morte. &#13;&#10;Este livro termina quando Poirot descobre que o verdadeiro assassino era irmão do 3 assassinado de quem queria herdar a fortuna e a morte dos outas pessoas era só para despistar. &#13;&#10;Eu gostei muito deste filme achei um livro muito interessante com bastante suspense e mistério como já é habitual nos livros de Agatha Christie.&#13;&#10;Nesse livro, somos levados pela Agatha Christie, o tempo inteiro, a acreditar em uma coisa, que apesar de parecer muito óbvia, nos parece verdadeira.&#13;&#10;Apesar de ter sido uma boa leitura e o final ter me surpreendido de alguma forma, &#13;&#10;Poirot fala palavras ou até mesmo frases em francês, e o livro não apresenta tradução, o que acabou deixando algumas partes um pouco confusas.&#13;&#10;Então aconselho-vos a ler este livro e para quem gosta de policiais este é um excelente livro pra lerem.&#13;&#10;', '/upload/docs/Os crimes do ABC.docx', 1, 1),
(28, 'Filosofia', 12, 'O livre-arbítrio parece, pois, ser um facto da nossa experiencia. Ele surge como a condição para que se possa falar em ação intencional.', 3, '2017-06-21 01:47:02', 'Diariamente, constatamos que são variadíssimas as experiencias que nos mostram que, embora tenhamos feito alguma coisa, poderíamos ter feito uma coisa diferente ou pe.lo menos, pensamos que sim.&#13;&#10;O livre-arbítrio parece, pois, ser um facto da nossa experiencia. Ele surge como a condição para que se possa falar em ação intencional.&#13;&#10;Se negamos que haja livre-arbítrio, teremos de achar estranha a nossa preocupação com as coisas, acabando por não fazer sentido nem o esforço nem a esperança. Se é verdade que podemos fazer umas coisas, também é certo que não podemos fazer outras, por isso temos alternativas.&#13;&#10;As condicionantes da Acão humana são todo o conjunto de constrangimentos e obstáculos que impõe limites a nossa ação. As condicionantes da Acão, ao mesmo tempo que a limitam, também tem um horizonte de possibilidades, assumindo se também, de certo modo, como condições do próprio agir.&#13;&#10;', '/upload/docs/filosofia.docx', 3, 0),
(29, 'Exercicios GPI', 14, 'Os meus exercicios de GPI', 23, '2017-06-21 01:50:56', '\r\nExercício 1\r\nDescrição do Projeto\r\nO projeto será uma aplicação de gestão de receitas de culinária, em que cada utilizador poderá inserir as suas próprias receitas detalhando os procedimentos e os ingredientes utilizados para realizar as mesmas;\r\nOrganização\r\nPingo Doce - Distribuição Alimentar, SA\r\nLigação Organização – Projeto\r\nA aplicação iria fazer a ligação dos ingredientes que os utilizadores inseriam nas suas receitas, com os produtos de marca própria do Pingo Doce, com o objetivo de dar a conhecer aos utilizadores a gama de produtos de marca própria que esta organização dispõe.\r\nPara o projeto, a organização Pingo Doce seria benéfica porque permitiria indicar ao utilizador onde poderia encontrar os produtos que necessita para as suas receitas.\r\nExercício 2 \r\nObjetivo\r\nO objetivo do projeto é fazer com que os produtos de marca própria do Pingo Doce ganhem notoriedade e reconhecimento por parte dos clientes, fazendo com que os mesmos tenham conhecimento da sua existência, diversidade e também qualidade;\r\nPara tal será desenvolvida uma aplicação de receitas culinárias que faça a integração dos ingredientes das mesmas com os produtos da marca Pingo Doce;\r\nEste projeto foi pensado para colmatar um desinteresse dos clientes neste tipo de produtos de marca própria, demonstrando por vezes pouca confiança na sua qualidade;\r\nNecessidades\r\nCliente – dar mais notoriedade aos produtos da sua marca própria;\r\nUtilizador – organizar as suas receitas e saber instantaneamente os produtos que pode encontrar no hipermercado Pingo Doce;\r\nSponsors – obter lucros nos investimentos que faz;\r\nExpectativas\r\nCliente – aumentar o volume de vendas dos produtos de marca própria;\r\nUtilizador – ter as suas receitas mais organizadas e sempre disponíveis no seu bolso;\r\nSponsors – Obter o máximo lucro possível;\r\nRequisitos\r\nEm relação aos requisitos do projeto será necessário fazer uma aplicação para dispositivos moveis que permita uma organização simples e intuitiva das receitas do utilizador, e uma boa integração dos ingredientes dessas mesmas receitas com a base de dados dos produtos de marca Pingo Doce. \r\nStackeholders \r\nAs principais partes interessadas (stackeholders) deste projeto serão o Pingo Doce como cliente, os seus acionistas como investidores diretos no projeto e o utilizador final da aplicação. O cliente será um dos stackeholders mais importantes porque é o principal interessado no projeto, e visto que os seus acionistas são os sponsors diretos do projeto aumenta a sua importante e influencia nas decisões a tomar. O utilizador final será o que menos influencia terá no projeto visto que não terá comunicação direta nem terá conhecimento do desenvolvimento do projeto. \r\n Pressupostos e Restrições\r\nPara a realização do projeto será pressuposto que o cliente terá de disponibilizar uma base de dados atualizada em tempo real com todos os produtos da sua marca e que a aplicação terá de ter um servidor de suporte á sincronização da mesma na cloud. \r\nÉ pressuposto também que os utilizadores tenham um dispositivo móvel com sistema operativo android e com ligação á internet. \r\nComo restrição existe o custo máximo que o cliente pretende despender com o produto e o valor máximo que os investidores estão dispostos a investir. \r\nGestor de Projeto\r\nO gestor de projeto proposto para este projeto serei eu mesmo, e terei autoridade e autonomia total, tendo sempre em consideração a influencia das partes interessadas.\r\nOrganograma\r\n\r\nCronograma\r\nFase 1 – 1 mês – analise e preparação do projeto; \r\nFase 2 – 2 meses – desenvolvimento da aplicação móvel;\r\nFase 3 – 1 mês – integração da base de dados do Pingo Doce com a aplicação e testes;\r\nOrçamento\r\n14 mil euros;\r\nExercício 3\r\nObjetivos\r\nO principal objetivo do projeto é fazer com que os produtos de marca própria do Pingo Doce ganhem notoriedade e reconhecimento por parte dos clientes, fazendo com que estes tenham conhecimento da sua existência, diversidade e também qualidade.\r\nEste projeto foi pensado para colmatar um desinteresse dos clientes neste tipo de produtos de marca própria, demonstrando por vezes pouca confiança na sua qualidade.\r\nUm dos critérios que vai poder medir o sucesso alcançado com o projeto será obviamente a quantidade de utilizadores que utilizarem a aplicação, mas o principal será o aumento das vendas dos produtos, aumento esse proveniente de um maior conhecimento e confiança nesses mesmos produtos por parte dos consumidores.\r\nPretende-se que o desvio orçamental seja o menor possível, visto que o projeto não é de todo vital para a organização, fazendo com que esta não pretenda despender muitos custos com o mesmo.\r\nÂmbito\r\nO projeto será uma aplicação de gestão de receitas de culinária, em que cada utilizador poderá inserir as suas próprias receitas detalhando os procedimentos e os ingredientes utilizados para realizar as mesmas.\r\nA aplicação será desenvolvida para o sistema operativo Android e ira suportar equipamentos com a versão 5.0 ou superiores do sistema operativo.\r\nA aplicação estará dividida em duas grandes áreas. \r\nUma delas será a inserção de novas receitas na base de dados. A receitas poderão ser acompanhadas de imagens descritivas provenientes da camara do equipamento ou do armazenamento do mesmo. \r\nPretende-se que exista uma unificação das designações dos ingredientes para mais facilmente serem associados aos produtos correspondentes e para isso existirá uma base de dados previamente carregada pelos desenvolvedores com uma enorme variedade de nomes de ingredientes habitualmente utilizadores e que o sistema reconheça qual o produto correspondente. \r\nOutra das principais áreas da aplicação será a pesquisa e a consulta das receitas, pesquisa essa acompanhada de inúmeros filtros para que possa ser encontrado o pretendido com a maior brevidade possível. Em cada receita serão vistos os seus procedimentos de execução e os seus ingredientes, com os correspondentes produtos de marca própria do Pingo Doce que foram automaticamente selecionados pela aplicação. \r\nRequisitos\r\nEm relação aos requisitos do projeto será necessário fazer uma aplicação para dispositivos moveis que permita uma organização simples e intuitiva das receitas do utilizador, e uma boa integração dos ingredientes dessas mesmas receitas com a base de dados dos produtos de marca Pingo Doce. \r\nDeverá ser possível identificar facilmente os produtos que correspondem aos devidos ingredientes, bem como os seus preços correspondentes.\r\nLimites\r\nNa aplicação estará disponível todas as correspondências possíveis entres os ingredientes das receitas e os produtos do Pingo Doce. Estes serão referenciados pelo nome, uma imagem identificativa e o seu preço atual. Na aplicação não será feita qualquer venda desses produtos nem existirá qualquer ligação a uma possível loja online da organização.\r\nEntregas\r\nNo inicio do desenvolvimento da aplicação serão disponibilizados protótipos (inicialmente não funcionais e posteriormente funcionais) para melhor demonstrar a interface gráfica da mesma. \r\nSerá também disponibilizado um manual de utilização da aplicação, que posteriormente virá integrado na mesma. \r\nNa fase de testes da aplicação será libertada uma versão inicial á organização e esse processo será repetido semanalmente até á conclusão do desenvolvimento.\r\nCritérios de aceitação\r\nO principal critério de aceitação do projeto será o correto funcionamento da aplicação e a implementação de todas as funcionalidades acordadas entre a organização e a equipa de desenvolvimento\r\nPressupostos\r\nPara a realização do projeto será pressuposto que o cliente terá de disponibilizar uma base de dados atualizada em tempo real com todos os produtos da sua marca e que a aplicação terá de ter um servidor de suporte á sincronização da mesma na cloud. \r\nSe a organização não disponibilizar uma base de dados com os produtos a associar a equipa de desenvolvimento não será capaz de fazer a devida correspondência entre os produtos e os ingredientes.\r\nÉ pressuposto também que os utilizadores tenham um dispositivo móvel com sistema operativo android e com ligação á internet. \r\nCaso esporadicamente o utilizador não tiver acesso á internet, a lista de produtos e os seus preços poderá não estar devidamente atualizada.\r\nRestrições\r\nComo restrição existe o custo máximo que o cliente pretende despender com o produto e o valor máximo que os investidores estão dispostos a investir. \r\nO facto de a organização requerer um orçamento reduzido, não será possível desenvolver também uma aplicação para dispositivos IOS e Windows Phone.\r\nOrganograma\r\nDefinição inicial dos riscos\r\nUm dos riscos iniciais do projeto é o orçamento reduzido, o que pode aumentar o stress do projeto e consequente colapso. \r\nEm termos da aplicação, existe o risco se a mesma não será tão utilizada como se previa e com isso não ser sentida qualquer influencia da mesma nos negócios da organização.\r\nCronograma\r\nMilestone 1 – 1 mês – analise e preparação do projeto;\r\nMilestone 2 – 2 meses – desenvolvimento da aplicação móvel;\r\nMilestone 3 – 2 semanas – fase de testes;\r\nLimitações de fundos\r\nOs sponsors do projeto serão os próprios acionistas da Organização Pingo Doce, e estes colocaram 15 mil euros como o teto máximo de investimento que estavam dispostos a fazer no projeto. \r\nEstimativa de custos\r\nÉ estimado que seja gasto 5000€ na analise, preparação e gestão do projeto e 9000€ com o desenvolvimento da aplicação e testes.\r\nRequisitos associados ao sistema de gestão da qualidade\r\n( ?????)\r\nDocumentos de especificação\r\n( ?????)\r\nRequisitos de aprovação\r\n(?????)\r\nExercício 4\r\nExercicio 34kcpfok\r\nEntregas: \r\nProject Charters\r\nProjeto global\r\n( entregar os requisitos)\r\n(faz os módulos separadamente)\r\n(junta os módulos)\r\n(testes de tudo junto)\r\n(conclusão)\r\nMicrosoft project\r\nEx:\r\nProject xpto\r\nINIC\r\nPROJECT CHARTER\r\nIDENTIFICIAR STACKHOLDERS\r\nAN ALTERNATICAS\r\nDOC PC\r\nPLAN\r\nF1\r\nDSFD\r\n \r\nTask mode / task name\r\n(tab para dizer que pertencem as de cima )COLUNA WBS\r\nExercício 5\r\nReçlacionamentos\r\nFinish to start F-S\r\nQuando acabar o outro, começo este\r\nFF \r\nQuando acabar o outro, acabo este\r\nSS,\r\nQuando começou o outro, começo este\r\nExercicio 6\r\nDONE\r\nExercício 7\r\n1.3.4.3 - Implementação de funcionalidades cruciais\r\nA fase de implementação das funcionalidades cruciais da aplicação é sem duvida uma das mais importantes do projeto, na medida que é aquela em que será gasto mais recursos;\r\nEsta fase deve acontecer posteriormente á fase 1.3.4.2 (Implementação do layout da aplicação) numa sequencia de Finish-to-Start;\r\n A principal entrada para o projeto será o documento de requisitos elaborado na fase 1.3.3 e o layout da aplicação já terminado, para que os mecanismos possam começar a ser desenvolvidos de acordo com esses requisitos, e tendo em consideração a interface desenvolvida;\r\nNesta fase devem ser desenvolvidas todas as funcionalidades cruciais da aplicação, deve se colocar todo o layout da aplicação funcional, fazer a conexão com a base de dados que ira armazenas as receitas do utilizador, e desenvolver o algoritmo que permita associar o maior numero de ingredientes das receitas a produtos da organização;\r\nA responsabilidade desta atividade será dos programadores envolvidos no projeto, pois todo o trabalho de programação será realizado por estes. Também o Gestor de Projetos e o Engenheiro de Software tem uma responsividade indireta visto que são este que fazem a supervisão do trabalho aqui desenvolvido. \r\nPara a realização desta atividade os programadores devem adotar uma metodologia ágil de desenvolvimento, dividindo a atividade em tarefas mais pequenas e toda a equipa aplicar o seu esforça numa tarefa de cada vez, e no final requisitar a aprovação do superior, neste caso o Engenheiro de Software. \r\nA saída do projeto será uma versão da aplicação já funcional, mas ainda sem todas as funcionalidades implementadas.\r\n  \r\ncenter329879Exercício 8\r\nFunção Descrição\r\nGestor de Projetos Faz o planeamento e gerenciamento de todo o projeto;\r\nTem a responsabilidade de garantir a execução do projeto conforme planeado;\r\nTem autoridade para adicionar ou cancelar atividades, contratar e despedir elementos da equipa \r\nEngenheiro de Software Responsável por realizar os documentos da engenharia de requisitos e supervisionar o desenvolvimento da aplicação,\r\nTem autoridade sobre os programadores, os testers e o designer, podendo dar ordens de alteração do trabalho realizado, sempre com o objetivo do cumprimento do planeamento \r\nProgramadores Desenvolve a aplicação\r\nDesigner Responsável por desenhar a interface gráfica da aplicação\r\nTesters Responsáveis por implementar e executar o plano de testes\r\nTêm a responsabilidade de comunicar todos os resultados ao Engenheiro de Software\r\nAtividade Gestor de Projetos Engenheiro de Software Programadores Designer Testers\r\nAquisição e Instalação de Servidor A R C I I\r\nR - Responsável por executar; A - Responsável por aprovar; C – Consultado; I – Informado;\r\nO responsável pelo recrutamento e pela gestão dos recursos humanos é o Gestor de Projetos, é este que tem a responsabilidade de calcular as necessidades e contratar a equipa que acha que melhor se ajusta ao projeto.\r\nA equipa será composta pelo Gestor de Projetos e pelos seguintes membros:\r\n1 Engenheiro de Software com experiencia mínima de 2 anos e com conhecimentos de metodologias ágeis de desenvolvimento de software;\r\n1 Designer gráfico com experiencia em desenhar ambientes gráficos para aplicações android;\r\n1 Programador Sénior com experiencia em Java e em desenvolvimento em para a plataforma android;\r\n2 Programadores Juniores com conhecimentos de Java e SQL;  \r\n2 Software Testers com experiencia mínima de 1 ano com ferramentas de testes em Java;\r\nOs Programadores Juniores terão uma formação intensiva de 2 semanas em Android SDK com o intuito de desenvolveres as capacidades necessárias para o desenvolvimento da aplicação;\r\nExercício 9\r\nNíveis de consequência e probabilidade associados ao risco (grau de risco):\r\nConsequência\r\nProbabilidade Reduzida Moderada Elevada\r\nRara 1 2 3\r\nProvável 4 5 6\r\nFrequente 7 8 9\r\nPrioridade:  Baixa  Média   Alta\r\nRisco Consequências Resposta Grau de risco\r\nMá perceção dos requisitos Equipa desenvolveu trabalho que será inutilizado; \r\nAtraso do Projeto; Reunir equipa e clarificar o requisito mal compreendido; 2\r\nBaixa produtividade da equipa de desenvolvimento Fraca qualidade do software produzido\r\nAtraso do Projeto Procurar incentivar a equipa;\r\nEm ultima instancia fazer substituições nos membros da equipa; 2\r\nIncompatibilidade entre sistemas de BD Atraso do Projeto;\r\nEquipa desenvolveu trabalho que será inutilizado; Desenvolvimento de sistema de interligação compatível; 2\r\nAtraso do Projeto Aumento do custo esperado do projeto;\r\nAumento da insatisfação dos stackholders; Aumentar horas de trabalho nas tarefas em atraso;\r\nEm ultima instancia contratação de pessoal; 5\r\nMá estimativa de custos e prazos Atraso do Projeto\r\nAumento dos custos do Projeto Reunir equipa e procurar calcular uma previsão mais correta; 6\r\nSaída inesperada de elementos da equipa  Atraso do Projeto\r\nFalta de conhecimento do projeto por parte do elemento que ir entrar na equipa Procurar anular essa saída através de incentivos;\r\nFormação especial para o novo membro; 3\r\nFalta de skills especificas por parte da equipa de desenvolvimento Atraso do Projeto;\r\nIncapacidade de cumprir com os requisitos; Dar formação necessária;\r\nSubcontratar a atividade a uma empresa externa; 3\r\n', '/upload/docs/Exercicios.docx', 2, 0),
(32, 'Relatório Documentos ABC', 14, 'Relatório trabalho prático', 28, '2017-07-05 10:28:44', '&#13;&#10;Escola Superior de Tecnologia e Gestão&#13;&#10;Documentos ABC&#13;&#10;Programação em Ambiente Web&#13;&#10;Licenciatura em Engenharia Informática&#13;&#10;2016/2017&#13;&#10;Joel Pereira – 8150138@estg.ipp.pt&#13;&#10;José Bernardes – 8150148@estg.ipp.pt&#13;&#10;Funcionalidades&#13;&#10;Registo/Autenticação&#13;&#10;É possível aos utilizadores registarem-se e autenticarem-se no site.&#13;&#10;Para o efeito, foi usado PHP.&#13;&#10;Perfil &#13;&#10;A um utilizador devidamente registado/autenticado é possível visualizar o seu perfil e edita-lo. É possível, também, visualizar os perfis de outros utilizadores.&#13;&#10;Utilizamos PHP para desenvolver esta funcionalidade.&#13;&#10;Importação/Criação de documentos&#13;&#10;A um utilizador devidamente registado/autenticado é possível criar e/ou importar documentos (.docx).&#13;&#10;Utilizamos PHP para desenvolver essa funcionalidade. Para a visibilidade do documento usamos AJAX, mais concretamente para pesquisar os utilizadores no qual queremos partilhar o documento. Também usamos AJAX para comentar os documentos.&#13;&#10;Gestão de documentos &#13;&#10;Edição&#13;&#10;É possível editar parâmetros de um documento.&#13;&#10;Utilizamos PHP para desenvolver esta funcionalidade. Para remover/adicionar os utilizadores com que queremos partilhar o documento usamos AJAX.&#13;&#10;Eliminação&#13;&#10;É possível eliminar documentos do site.&#13;&#10;Foi utilizado PHP para o desenvolvimento desta funcionalidade.&#13;&#10;Pesquisa&#13;&#10;  A pesquisa é feita segundo o título do documento ou autor (email) do mesmo.&#13;&#10;  Usamos PHP e AJAX para desenvolver esta funcionalidade. &#13;&#10;Alertas&#13;&#10;Sempre que um utilizador partilha um documento com outros, esses outros recebem uma notificação no canto superior direito. Depois de clicada, essa notificação redireciona para uma página de alertas com a informação do alerta. A seguir à visualização do alerta, o utilizador pode marca-lo como visto e este será eliminado.&#13;&#10;Foi usado PHP e AJAX para o desenvolvimento desta funcionalidade.&#13;&#10;Administrador&#13;&#10;Validar/Invalidar contas &#13;&#10;É possível ao administrador, caso esteja devidamente autenticado, ativar e desativar as contas dos utilizadores.&#13;&#10;Para o efeito, usamos as linguagens PHP e AJAX.&#13;&#10;Gerir Categorias&#13;&#10;Com esta funcionalidade é possível ao administrador adicionar e remover categorias ao site.&#13;&#10;Para o efeito, usamos PHP E AJAX.&#13;&#10;Área Pública&#13;&#10;É possível ver os 10 últimos documentos, no entanto só podem ser acedidos conforme as permissões dadas.&#13;&#10;Para a funcionalidade acima foi usado PHP e SQL.&#13;&#10;É possível pesquisar os documentos, por título ou utilizador, no entanto os resultados da pesquisa serão filtrados por permissões.&#13;&#10;Para a funcionalidade acima foi usado PHP e AJAX.&#13;&#10;Também, é possível ver os documentos por categoria e estes também serão filtrados por permissões.&#13;&#10;Para a funcionalidade acima foi usado PHP.&#13;&#10;Extra&#13;&#10;Documentos – Palavra-chave&#13;&#10;Sempre que é apresentada informação de uma palavra-chave, esta quando clicada redirecionará para uma pagina onde será feita uma impressão dos documentos com essa mesma palavra-chave, obviamente filtrados por permissões.&#13;&#10;Para o desenvolvimento desta funcionalidade foi usado PHP.&#13;&#10;Password&#13;&#10;No login e no registo, é possível aquando a introdução da password coloca-la visível e/ou coloca-la no seu estado normal.&#13;&#10;Para o desenvolvimento desta funcionalidade foi usado PHP E JQUERY.&#13;&#10;Não Implementado&#13;&#10;3.1.Observações locais a documentos que devem ficar armazenadas offline;&#13;&#10;Distribuição do trabalho&#13;&#10;Consideramos que depois de realizado o trabalho a distribuição que melhor se enquadra será 50/50, uma vez que contribuímos de igual forma para o desenvolvimento do mesmo.&#13;&#10;Arquitetura da plataforma&#13;&#10;A plataforma está dividida em três áreas distintas, a área de cliente, a área do servidor e a base de dados;&#13;&#10;A área do servidor comunica diretamente com a área de cliente e com a base de dados;&#13;&#10;A área de cliente apenas comunica com a base de dados, e indiretamente, através de AJAX;&#13;&#10;A base de dados serve de apoio a toda a plataforma como repositório central da informação;&#13;&#10;Manual de Instalação&#13;&#10;Instalação&#13;&#10;O projeto está configurado para ter uma base dados com a estrutura da enviada em anexo, e com o nome ‘documentos_abc’;&#13;&#10;É necessário um servidor APACHE e MYSQL para que o PHP seja executado e a base de dados guardada, respetivamente;&#13;&#10;Os utilizadores predefinidos são:&#13;&#10;Email PassAuthLeveljoseabernardes@gmail.com Paulo123! ADMIN&#13;&#10;joel@joel.com JoelJoel15! ADMIN&#13;&#10;alberto@alberto.com alberto@alberto.com USERINACTIVE&#13;&#10;Observações finais:&#13;&#10;Ao modulo da base de dados disponibilizado no moodle foi adicionada uma linha de código á função ‘insert’, para que esta retorne o ID da linha inserida na base de dados;&#13;&#10;Esta funcionalidade já tinha sido previamente aceite pelo docente;&#13;&#10;', '/upload/docs/Relatório-DocumentosABC.docx', 2, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentediting`
--

CREATE TABLE `documentediting` (
  `EditingID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  `EditingReason` longtext NOT NULL,
  `EditingDATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `documentediting`
--

INSERT INTO `documentediting` (`EditingID`, `DocumentID`, `EditingReason`, `EditingDATE`) VALUES
(36, 27, 'Erro ortográfico corrigido', '2017-06-21 01:43:13'),
(39, 28, 'ttt', '2017-06-27 12:47:05'),
(40, 28, 'hh', '2017-06-27 12:47:34'),
(43, 28, 'dd', '2017-06-28 12:03:59'),
(44, 10, 's', '2017-06-28 12:51:40'),
(45, 26, 'dd', '2017-06-28 12:51:53'),
(46, 28, 'ff', '2017-07-03 11:43:21'),
(47, 28, 'ss', '2017-07-03 11:44:22'),
(48, 28, 'p', '2017-07-03 11:44:38'),
(49, 28, 'o', '2017-07-03 11:44:54'),
(50, 28, 'f', '2017-07-03 11:52:53'),
(51, 26, 'u', '2017-07-03 18:04:06'),
(56, 10, 'p', '2017-07-05 12:31:24'),
(57, 10, 'D', '2017-07-05 12:31:42'),
(58, 10, 'O', '2017-07-05 12:32:26'),
(59, 10, 'WER', '2017-07-05 12:34:24'),
(60, 10, 'a', '2017-07-05 12:36:59'),
(61, 32, 'add', '2017-07-05 14:14:50'),
(62, 32, 'u', '2017-07-05 14:18:53'),
(64, 32, 'remo', '2017-07-05 14:21:25'),
(65, 32, 'u', '2017-07-05 14:24:37'),
(66, 32, 'l', '2017-07-05 14:27:51'),
(67, 32, 'i', '2017-07-05 14:28:18'),
(69, 32, 'y', '2017-07-05 15:20:18'),
(70, 32, 'p', '2017-07-05 15:21:26'),
(71, 32, 'p', '2017-07-05 15:22:42'),
(72, 32, 'p', '2017-07-05 15:23:37'),
(76, 32, '8', '2017-07-05 15:27:53'),
(77, 32, 'oi', '2017-07-05 15:28:52'),
(79, 32, '8', '2017-07-05 15:29:29'),
(89, 28, 'e', '2017-07-05 17:45:12'),
(90, 10, 'e', '2017-07-05 18:19:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `document_tag`
--

CREATE TABLE `document_tag` (
  `TagName` varchar(50) NOT NULL,
  `DocumentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `document_tag`
--

INSERT INTO `document_tag` (`TagName`, `DocumentID`) VALUES
('aaaa', 10),
('abc', 27),
('estg', 32),
('filosofia', 28),
('gpi', 29),
('livro', 27),
('netbeans', 26),
('paw', 32),
('s', 10),
('ss', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `document_user_shared`
--

CREATE TABLE `document_user_shared` (
  `DocumentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DocumentUserCOMMENTS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `document_user_shared`
--

INSERT INTO `document_user_shared` (`DocumentID`, `UserID`, `DocumentUserCOMMENTS`) VALUES
(28, 11, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `token`
--

CREATE TABLE `token` (
  `TokenID` varchar(100) NOT NULL,
  `TokenVALUE` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `token`
--

INSERT INTO `token` (`TokenID`, `TokenVALUE`) VALUES
('a925b78bf6d846d81c121019b7258ca31690e605f732ce82b69a4e3ca26a5cf6', '$2y$10$vn5FfkeK/vo0nH0PlteUv.D7tjd.1P95lmP72ofVQuRdY1cVKOjE2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserPASS` varchar(100) NOT NULL,
  `UserEMAIL` varchar(50) NOT NULL,
  `UserNAME` varchar(100) NOT NULL,
  `UserPHOTO` varchar(1000) NOT NULL,
  `UserPHONE` int(9) DEFAULT NULL,
  `UserAUTHLEVEL` enum('USER','ADMIN','USERINACTIVE','') NOT NULL DEFAULT 'USERINACTIVE',
  `UserADDRESS` int(11) NOT NULL,
  `UserTokenID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`UserID`, `UserPASS`, `UserEMAIL`, `UserNAME`, `UserPHOTO`, `UserPHONE`, `UserAUTHLEVEL`, `UserADDRESS`, `UserTokenID`) VALUES
(11, '$2y$10$9fUhAeynP6eoyWNLB6y9hOcfd8zglu1lPthuuHTAKp0eYi7lixelK', 'joseabernardes@gmail.com', 'José Bernardes', '/upload/images/595a64db2afb3-avatar2016.png', 917877723, 'ADMIN', 5, NULL),
(12, '$2y$10$6bU31HWWYGAIvzhIXsCBgOBO2oReCQhj7paai7e1H9aL41z4jjDD.', 'paulo@paulo.com', 'Paulo Joaquim', '/upload/images/show.png', 917877753, 'USER', 6, NULL),
(14, '$2y$10$k7Nhu2JOx88vp6zLWYpuceKporRZjzBGNeSfd0VepqY0WLpbiSN0.', 'joel@joel.com', 'Joel Pereira Ribeiro', '/upload/images/16960-code-1920x1200-computer-wallpaper.jpg', 922222222, 'ADMIN', 7, 'a925b78bf6d846d81c121019b7258ca31690e605f732ce82b69a4e3ca26a5cf6'),
(15, '$2y$10$.rbxiH8djmUXoKtcJN5.i.zt8Q0WcUoDopqXNWgIhfxpUdThGoMeW', 'alberto@alberto.com', 'Alberto Pereira', '/upload/images/Mountainous_View_by_Sven_Scheuermeier-1600.jpg', 917877723, 'USER', 8, NULL),
(16, '$2y$10$JhiBUbluWR.FacFbjQpRheny.mf0/k0Xm2OqNwCJ11RNARpMEyLbW', 'aaa2@gmail.com', 'aaa', '/upload/images/182208_199704060043306_5753163_n.jpg', 912222222, 'USERINACTIVE', 9, NULL),
(17, '$2y$10$iiWU7apckYpyxByeQY3q5ezegS40kYuDP79pFW6pkuzh1tvFTWfVm', 'roberto@gmail.com', 'Roberto', '/upload/images/IMG_20160827_113258-2.jpg', 917877752, 'USERINACTIVE', 10, NULL),
(18, '$2y$10$DCZzB.rUnYaD.N.mLmT1N.3pvHTD4D2xKmlpBB34cTOkYGhTmKAqq', 'lauro@gmail.com', 'Lauro', '/upload/images/594f80bf8e1e4-show.png', 912121332, 'USERINACTIVE', 11, NULL),
(19, '$2y$10$XrDUYpX4eWksDmrR3bWmzuitOZyCOqWCa0hpBBGOgnh9STCGelDb.', 'joseabernardes@gmail.comb', 'Paulo', '/upload/images/59524c328644d-Mountainous_View_by_Sven_Scheuermeier-1600.jpg', 912244444, 'USERINACTIVE', 12, NULL),
(26, '$2y$10$wKtVQmwZSMjHSBe2kL6ZWepJOgzIoprTvRJD6iwqzyWoFDTGfy5V.', 'pedro@pedro.com', 'abc', '/upload/images/59528b2e01d38-16960-code-1920x1200-computer-wallpaper.jpg', 999999999, 'USERINACTIVE', 19, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visibility`
--

CREATE TABLE `visibility` (
  `VisibilityID` int(11) NOT NULL,
  `VisibilityNAME` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `visibility`
--

INSERT INTO `visibility` (`VisibilityID`, `VisibilityNAME`) VALUES
(1, 'public'),
(2, 'private'),
(3, 'shared');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`AlertID`),
  ADD KEY `AlertUserID` (`AlertUserID`),
  ADD KEY `AlertDocumentID` (`AlertDocumentID`),
  ADD KEY `AlertUserSendID` (`AlertUserSendID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `CommentDocumentID` (`CommentDocumentID`),
  ADD KEY `CommentUserID` (`CommentUserID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`DocumentID`),
  ADD KEY `IX_USER` (`DocumentUserID`),
  ADD KEY `IX_CATEGORY` (`DocumentCategoryID`),
  ADD KEY `IX_VISIBILITY` (`DocumentVisibilityID`) USING BTREE;

--
-- Indexes for table `documentediting`
--
ALTER TABLE `documentediting`
  ADD PRIMARY KEY (`EditingID`),
  ADD KEY `IX_DOCUMENT` (`DocumentID`);

--
-- Indexes for table `document_tag`
--
ALTER TABLE `document_tag`
  ADD PRIMARY KEY (`TagName`,`DocumentID`),
  ADD KEY `IX_DOCUMENT` (`DocumentID`) USING BTREE;

--
-- Indexes for table `document_user_shared`
--
ALTER TABLE `document_user_shared`
  ADD PRIMARY KEY (`DocumentID`,`UserID`),
  ADD KEY `DocumentID` (`DocumentID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`TokenID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEMAIL_2` (`UserEMAIL`),
  ADD KEY `IX_TOKEN` (`UserTokenID`) USING BTREE,
  ADD KEY `IX_ADDRESS` (`UserADDRESS`) USING BTREE,
  ADD KEY `UserEMAIL` (`UserEMAIL`);

--
-- Indexes for table `visibility`
--
ALTER TABLE `visibility`
  ADD PRIMARY KEY (`VisibilityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `alert`
--
ALTER TABLE `alert`
  MODIFY `AlertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `DocumentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `documentediting`
--
ALTER TABLE `documentediting`
  MODIFY `EditingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alert`
--
ALTER TABLE `alert`
  ADD CONSTRAINT `alert_ibfk_1` FOREIGN KEY (`AlertUserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `alert_ibfk_2` FOREIGN KEY (`AlertDocumentID`) REFERENCES `document` (`DocumentID`),
  ADD CONSTRAINT `alert_ibfk_3` FOREIGN KEY (`AlertUserSendID`) REFERENCES `user` (`UserID`);

--
-- Limitadores para a tabela `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`CommentDocumentID`) REFERENCES `document` (`DocumentID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`CommentUserID`) REFERENCES `user` (`UserID`);

--
-- Limitadores para a tabela `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_3` FOREIGN KEY (`DocumentVisibilityID`) REFERENCES `visibility` (`VisibilityID`),
  ADD CONSTRAINT `document_ibfk_4` FOREIGN KEY (`DocumentUserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `document_ibfk_5` FOREIGN KEY (`DocumentCategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Limitadores para a tabela `documentediting`
--
ALTER TABLE `documentediting`
  ADD CONSTRAINT `documentediting_ibfk_1` FOREIGN KEY (`DocumentID`) REFERENCES `document` (`DocumentID`);

--
-- Limitadores para a tabela `document_tag`
--
ALTER TABLE `document_tag`
  ADD CONSTRAINT `document_tag_ibfk_2` FOREIGN KEY (`DocumentID`) REFERENCES `document` (`DocumentID`);

--
-- Limitadores para a tabela `document_user_shared`
--
ALTER TABLE `document_user_shared`
  ADD CONSTRAINT `document_user_shared_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `document_user_shared_ibfk_4` FOREIGN KEY (`DocumentID`) REFERENCES `document` (`DocumentID`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`UserTokenID`) REFERENCES `token` (`TokenID`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`UserADDRESS`) REFERENCES `address` (`AddressID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
