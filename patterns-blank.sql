--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: pattern; Type: TABLE; Schema: public; Owner: patterns
--

CREATE TABLE public.pattern (
    idpattern bigint NOT NULL,
    patternpublisher bigint,
    patternnum character varying(8),
    patternsize character varying(45),
    patternbust character varying(45),
    patternwaist character varying(45),
    patternhips character varying(45),
    patternera character varying(45),
    patterngender character varying(6),
    patterndesc character varying(145),
    patternorigprice character varying(45),
    patternnotes character varying(45)
);


ALTER TABLE public.pattern OWNER TO patterns;

--
-- Name: COLUMN pattern.patternpublisher; Type: COMMENT; Schema: public; Owner: patterns
--

COMMENT ON COLUMN public.pattern.patternpublisher IS 'FK';


--
-- Name: pattern_idpattern_seq; Type: SEQUENCE; Schema: public; Owner: patterns
--

CREATE SEQUENCE public.pattern_idpattern_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pattern_idpattern_seq OWNER TO patterns;

--
-- Name: pattern_idpattern_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: patterns
--

ALTER SEQUENCE public.pattern_idpattern_seq OWNED BY public.pattern.idpattern;


--
-- Name: publisher_idpublisher_seq; Type: SEQUENCE; Schema: public; Owner: patterns
--

CREATE SEQUENCE public.publisher_idpublisher_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publisher_idpublisher_seq OWNER TO patterns;

--
-- Name: publisher; Type: TABLE; Schema: public; Owner: patterns
--

CREATE TABLE public.publisher (
    idpublisher integer DEFAULT nextval('public.publisher_idpublisher_seq'::regclass) NOT NULL,
    publishername character varying(45) NOT NULL
);


ALTER TABLE public.publisher OWNER TO patterns;

--
-- Name: pattern idpattern; Type: DEFAULT; Schema: public; Owner: patterns
--

ALTER TABLE ONLY public.pattern ALTER COLUMN idpattern SET DEFAULT nextval('public.pattern_idpattern_seq'::regclass);


--
-- Data for Name: pattern; Type: TABLE DATA; Schema: public; Owner: patterns
--

COPY public.pattern (idpattern, patternpublisher, patternnum, patternsize, patternbust, patternwaist, patternhips, patternera, patterngender, patterndesc, patternorigprice, patternnotes) FROM stdin;
\.


--
-- Data for Name: publisher; Type: TABLE DATA; Schema: public; Owner: patterns
--

COPY public.publisher (idpublisher, publishername) FROM stdin;
1	Anne Adams
2	Blackmore
3	Burda
4	Butterick
5	Fashion
6	Kwik Sew
7	Maudella
8	McCalls
9	Paragon
10	Pauline
11	Simplicity
12	Style
13	Vogue
14	Weigels
15	Academy
16	Womans Day
17	Australian Home Journal
18	Marian Martin
19	Womans World
20	Favorite Pattern Service
21	Multisize Pattern
22	English Woman
23	Pictorial Review
\.


--
-- Name: pattern_idpattern_seq; Type: SEQUENCE SET; Schema: public; Owner: patterns
--

SELECT pg_catalog.setval('public.pattern_idpattern_seq', 1, true);


--
-- Name: publisher_idpublisher_seq; Type: SEQUENCE SET; Schema: public; Owner: patterns
--

SELECT pg_catalog.setval('public.publisher_idpublisher_seq', 23, true);


--
-- PostgreSQL database dump complete
--

