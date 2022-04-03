#include	                                                	<   a_samp   >
#include                                                		<   a_http   >
#include                                                		<   a_mysql  >
#include                                                		<   zcmd     >
#include                                                		<   sscanf2  >
#include                                                		<   foreach  >
#include                                                		<   streamer >
#include                                                        <   mSelection >
#include                                                        <   dini 	 >
#include                                                        <   AntiCleo >
#include														<   a_actor >
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#define 														MAX_CARS        100
#define 														MAX_VEH         500
#define 														MAX_PROPS       100
#define														    MAX_HOUSES      1150
#define                                                 		MAX_PCARS       19
#define                                                 		MAX_GANGS       10
#define                                                 		MAX_CHECKPOINTS 10
#define                                                         MAX_HOLDS       10
#define                                                         MAX_JOBS        10
//------------------------------------------------------------------------------
#define MAX_CP 		  														120
#define MAX_RACES 														    100
#define	MAX_COUNT     														30
#define MAX_RACE_TIME 														300
#define CP_SIZE 	 														12.0
#define SPECIAL_ACTION_PISSING 												68
#define                                                         MAX_DRIFTS      6
#define                                                         MAX_DRIFT1_CP   24
#define                                                         MAX_DRIFT2_CP   13
#define                                                         MAX_DRIFT3_CP   16
#define                                                         MAX_DRIFT4_CP   20
#define                                                         MAX_DRIFT5_CP   12
#define                                                         MAX_DRIFT6_CP   14
#define                                                 		MAX_RACE_CP 	150
#pragma                                                 		dynamic         12000
#define 														VEHICLE_PLAYER  2
#define 														MAX_VEHICLE_ATTACHED_OBJECTS (8)
#define 														CAPTURE_TIME    60
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#define 														CONTENT_TIME 	3
#define 														Content_MATH 	0
#define 														Content_TYPE 	1
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#define                                                 	WHITE       	0xFFFFFFAA
#define                                                 	RED         	0xFF0000AA
#define                                                 	YELLOW      	0xFFFF00AA
#define                                                 	BLUE        	0x395DFFAA
#define                                                 	Blue        	0x0072FFAA
#define                                                 	LBLUE       	0x00BBF6AA
#define                                                 	LIME        	0x00FF00AA
#define                                                 	AQUA        	0x49FFFFAA
#define                                                		ORANGE      	0xFF9900AA
#define                                                		GREY        	0xCEC8C8AA
#define														Grey			0xAFAFAFAA
#define                                                 	GREEN       	0x33AA33AA
#define                                                     Green           0x05C81FAA
#define														BEST			0x33CCFFAA
#define														SERVER			0x517FFFAA
#define COLOR_DUEL                                                  (0x3B83FFAA)
// ( Hex Colors )
#define S                      								"{3399ff}"
#define G                      								"{6EF83C}"
#define R                       							"{F81414}"
#define W                      								"{FFFFFF}"
#define O                      								"{FFAF00}"
#define YE                              					"{FFFF00}"
#define GRI	                            					"{C0C0C0}"
#define RSC1                            					"{00FFFB}"
#define RSC2                            					"{00FF1E}"
#define SRV_C                                               "{FFDF00}"
#define LB_C    											"{00a7c2}"
#define P_C     											"{faa8e3}"
#define V_C                                                 "{A307DB}"
#define ADM_CC 												"{25ADCC}"
#define L_YE    											"{f0e690}"
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
#define                                                 	Teles_D         120
#define                                                 	House_D    		140
#define                                                 	Property_D 		160
#define                                                     D_BWEAPONS      180
#define                                                     AddH/P          200
#define                                                		MP3_D      		220
#define                                                     Speed_D         240
#define                                                     VUP_D           260
#define                                                     Clicked_D       280
#define                                                     Clan_D          300
#define                                                     Gang_D          320
#define                                                     Control_D       340
#define                                                     Walks_D         360
#define                                                   	Stunt_D         380
#define                                                     Race_D          400
#define                                                     Jobs_D          420
#define                                                     Drifts_D        440
#define                                                     C4_D            460
#define                                                     PM_D            480
#define                                                     Top_D           500
#define                                                     DIALOG_CMDS     520
#define                                                     Star_D          540
#define                                                     D_NEWS          560
#define                                                     DIALOG_LANG     580
#define 													D_WEAPONS 		600
#define 													D_FWEAPONS      620
#define														vAccount_D      640
#define														DIALOG_SHOP		660
#define														DIALOG_PCAR		680
#define                                                     DIALOG_RANKS    700
#define                                                     DIALOG_CnR      720
#define 													PCar_D          740
#define                         							Question_D      760
#define                         							WhoSayFirst_D 	780
#define                         							WhoMakeMostKills_D 800
#define                                                     DUEL_D          820
#define                                                     DIALOG_SETTINGS 840
//------------------------------------------------------------------------------
#define	TEAM_COPS 1
#define	TEAM_ROBBERS 2
#define MAX_MINES 5
#define MAX_TRADE 10
#define MAX_TRADE_STRING 256
#define MAX_SERVERMINES 100
#define ESS playerid, params[]
#define SPD ShowPlayerDialog
#define SCMALL SendClientMessageToAll
#define LIST DIALOG_STYLE_LIST
#define MSGBOX DIALOG_STYLE_MSGBOX
#define INPUT DIALOG_STYLE_INPUT
#define PASS DIALOG_STYLE_PASSWORD
#define HEADERS DIALOG_STYLE_TABLIST_HEADERS
#define CACHE cache_get_field_content_int
#define FLOAT cache_get_field_content_float
#define CONTENT cache_get_field_content
#define MAX_CONNECTIONS_FROM_IP 10
//------------------------------------------------------------------------------
// EOS for all strings cmds & dialogs = 4096 max string
//------------------------------------------------------------------------------
enum attached_object_data
{
	ao_model,
	ao_bone,
	Float:ao_x,
	Float:ao_y,
	Float:ao_z,
	Float:ao_rx,
	Float:ao_ry,
	Float:ao_rz,
	Float:ao_sx,
	Float:ao_sy,
	Float:ao_sz
};
enum v_attached_object_data
{
	liModel,
	Float:lfVO_X,
	Float:lfVO_Y,
	Float:lfVO_Z,
	Float:lfVO_RX,
	Float:lfVO_RY,
	Float:lfVO_RZ
};
new 
	eLog[1024],
	aLog[1024], 
	eQuery[4096], 
	eString[4096], 
	GangKiller[MAX_PLAYERS],
	JailName[MAX_PLAYERS], 
	JailedBy, 
	BeachSpawn[18],
	CountSpawn[MAX_PLAYERS],
	CarRadio[MAX_PLAYERS], 
	WarInvitedBy, 
	WarBy[MAX_PLAYERS],
	SpawnZonePickup[15], 
	VUPLimit[MAX_PLAYERS],
	vehlist = mS_INVALID_LISTID, 
	boatlist = mS_INVALID_LISTID, 
	planelist = mS_INVALID_LISTID,
	bikelist = mS_INVALID_LISTID,
	lskinlist = mS_INVALID_LISTID, 
	mskinlist = mS_INVALID_LISTID, 
	c_weapons[6] = mS_INVALID_LISTID,
	enginex,
	lightss,
	alarmx,
	doorsx,
	bonnetx,
	bootx,
	objectivex,
	Text:TD_Death[2],
	Text:CAPTURE[2],
	SpawnInDM[MAX_PLAYERS][20],
	RandomPickUP[128],
	AntiSadSpam[MAX_PLAYERS],
	grider[MAX_PLAYERS][3],
	liPlayerRank,
	totalMines[MAX_PLAYERS],
	serverMines[MAX_SERVERMINES],
	bool:isLive[MAX_SERVERMINES],
	bool:isImmune[MAX_PLAYERS],
	objectMine,
	p_Object[MAX_PLAYERS][MAX_VEHICLE_ATTACHED_OBJECTS],
    mHold[9] = mS_INVALID_LISTID,
    SellName[MAX_PLAYERS][MAX_TRADE][MAX_TRADE_STRING],
    BuyName[MAX_PLAYERS][MAX_TRADE][MAX_TRADE_STRING],
    SellOption[MAX_PLAYERS][MAX_TRADE],
    BuyOption[MAX_PLAYERS][MAX_TRADE],
    SellAmount[MAX_PLAYERS][MAX_TRADE],
    BuyAmount[MAX_PLAYERS][MAX_TRADE],
    Text:ShowInfo[MAX_PLAYERS],
    Attach_Info[ 	MAX_PLAYERS 	][ MAX_PLAYER_ATTACHED_OBJECTS ]	[ attached_object_data ],
	V_Attach[ 		MAX_PLAYERS 	][ MAX_VEHICLE_ATTACHED_OBJECTS ]	[ v_attached_object_data ],
	TD_InfoTimer	[ MAX_PLAYERS ],
	NDelete[MAX_PLAYER_NAME],
	GMCount = 5,
	BuildRace,				     BuildRaceType,	            BuildVehicle,		       BuildCreatedVehicle,
	BuildModeVID,			     BuildName[30],	            bool:BuildTakeVehPos,      BuildVehPosCount,
	bool:BuildTakeCheckpoints,   BuildCheckPointCount,      RaceBusy = 0x00,		   RaceName[30],
	RaceVehicle,				 RaceType,			        TotalCP,                   CountAmount,
	Float:RaceVehCoords[2][4],   Float:CPCoords[MAX_CP][4], CountTimer,                bool:Joined[MAX_PLAYERS],
	CreatedRaceVeh[MAX_PLAYERS], Index,						PlayersCount[2],		   RaceTick,
	RaceStarted,				 CPProgess[MAX_PLAYERS],	Position,				   FinishCount,
	JoinCount,					 sCounter,					RaceTime,                  TimeProgress,
	InfoTimer[MAX_PLAYERS],		 RacePosition[MAX_PLAYERS],	RaceNames[MAX_RACES][128], TotalRaces,
	bool:AutomaticRace,			 ReacReward,
	RestartTime,
	RestartReason[256],
	Text:RestartTD,
	ALLY,
	Text:TD_CONNECT[10],
	Float:BALLONS[ ][ 3 ] =
	{
	{ 1826.7213,-1204.1338,64.0803 },		//balloon 1
	{ 1825.9105,-1221.2755,64.0803 },		//balloon 2
	{ 1826.0659,-1238.6827,64.0803 },		//balloon 3
	{ 1810.0537,-1245.3776,64.0803 }		//balloon 4
	},
 	BALLON_SET[ sizeof BALLONS ][ 4 ],
	BALLON[ MAX_PLAYERS ][ 2 ],
	PlayerColors[207] =
	{
	0xFF8C13FF,0xC715FFFF,0x20B2AAFF,0xDC143CFF,0x6495EDFF,0xf0e68cFF,0x778899FF,0xFF1493FF,0xF4A460FF,
	0xEE82EEFF,0xFFD720FF,0x8b4513FF,0x4949A0FF,0x148b8bFF,0x14ff7fFF,0x556b2fFF,0x0FD9FAFF,0x10DC29FF,
	0x534081FF,0x0495CDFF,0xEF6CE8FF,0xBD34DAFF,0x247C1BFF,0x0C8E5DFF,0x635B03FF,0xCB7ED3FF,0x65ADEBFF,
	0x5C1ACCFF,0xF2F853FF,0x11F891FF,0x7B39AAFF,0x53EB10FF,0x54137DFF,0x275222FF,0xF09F5BFF,0x3D0A4FFF,
	0x22F767FF,0xD63034FF,0x9A6980FF,0xDFB935FF,0x3793FAFF,0x90239DFF,0xE9AB2FFF,0xAF2FF3FF,0x057F94FF,
	0xB98519FF,0x388EEAFF,0x028151FF,0xA55043FF,0x0DE018FF,0x93AB1CFF,0x95BAF0FF,0x369976FF,0x18F71FFF,
	0x4B8987FF,0x491B9EFF,0x829DC7FF,0xBCE635FF,0xCEA6DFFF,0x20D4ADFF,0x2D74FDFF,0x3C1C0DFF,0x12D6D4FF,
	0x48C000FF,0x2A51E2FF,0xE3AC12FF,0xFC42A8FF,0x2FC827FF,0x1A30BFFF,0xB740C2FF,0x42ACF5FF,0x2FD9DEFF,
	0xFAFB71FF,0x05D1CDFF,0xC471BDFF,0x94436EFF,0xC1F7ECFF,0xCE79EEFF,0xBD1EF2FF,0x93B7E4FF,0x3214AAFF,
	0x184D3BFF,0xAE4B99FF,0x7E49D7FF,0x4C436EFF,0xFA24CCFF,0xCE76BEFF,0xA04E0AFF,0x9F945CFF,0xDCDE3DFF,
	0x10C9C5FF,0x70524DFF,0x0BE472FF,0x8A2CD7FF,0x6152C2FF,0xCF72A9FF,0xE59338FF,0xEEDC2DFF,0xD8C762FF,
	0xD8C762FF,0xFF8C13FF,0xC715FFFF,0x20B2AAFF,0xDC143CFF,0x6495EDFF,0xf0e68cFF,0x778899FF,0xFF1493FF,
	0xF4A460FF,0xEE82EEFF,0xFFD720FF,0x8b4513FF,0x4949A0FF,0x148b8bFF,0x14ff7fFF,0x556b2fFF,0x0FD9FAFF,
	0x10DC29FF,0x534081FF,0x0495CDFF,0xEF6CE8FF,0xBD34DAFF,0x247C1BFF,0x0C8E5DFF,0x635B03FF,0xCB7ED3FF,
	0x65ADEBFF,0x5C1ACCFF,0xF2F853FF,0x11F891FF,0x7B39AAFF,0x53EB10FF,0x54137DFF,0x275222FF,0xF09F5BFF,
	0x3D0A4FFF,0x22F767FF,0xD63034FF,0x9A6980FF,0xDFB935FF,0x3793FAFF,0x90239DFF,0xE9AB2FFF,0xAF2FF3FF,
	0x057F94FF,0xB98519FF,0x388EEAFF,0x028151FF,0xA55043FF,0x0DE018FF,0x93AB1CFF,0x95BAF0FF,0x369976FF,
	0x18F71FFF,0x4B8987FF,0x491B9EFF,0x829DC7FF,0xBCE635FF,0xCEA6DFFF,0x20D4ADFF,0x2D74FDFF,0x3C1C0DFF,
	0x12D6D4FF,0x48C000FF,0x2A51E2FF,0xE3AC12FF,0xFC42A8FF,0x2FC827FF,0x1A30BFFF,0xB740C2FF,0x42ACF5FF,
	0x2FD9DEFF,0xFAFB71FF,0x05D1CDFF,0xC471BDFF,0x94436EFF,0xC1F7ECFF,0xCE79EEFF,0xBD1EF2FF,0x93B7E4FF,
	0x3214AAFF,0x184D3BFF,0xAE4B99FF,0x7E49D7FF,0x4C436EFF,0xFA24CCFF,0xCE76BEFF,0xA04E0AFF,0x9F945CFF,
	0xDCDE3DFF,0x10C9C5FF,0x70524DFF,0x0BE472FF,0x8A2CD7FF,0x6152C2FF,0xCF72A9FF,0xE59338FF,0xEEDC2DFF,
	0xD8C762FF,0xD8C762FF,0xFFFFFFAA,0xFFCC00AA,0xFFEB7BAA,0xFF9900AA,0x00BBF6AA,0xAFAFAFAA,0x0072FFAA,
	},
	CP[MAX_PLAYERS],
    JobVehicle[MAX_PLAYERS],
    TruckerRoute[MAX_PLAYERS],
    Trailer[MAX_PLAYERS],
    Float:TruckerPos[15][3] = {
	{2881.4380, 2423.8945, 10.8605},
	{1477.2136, 2366.1448, 10.8537},
	{-2637.3337, 1359.4601, 7.0420},
	{2557.0935, -2407.1753, 13.7271},
	{-573.4742, -1063.7534, 23.5106},
	{-1010.4310, -605.2584, 31.9820},
	{-1990.8043, 142.1562, 27.5177},
	{-2794.5281, 787.3508, 49.4126},
	{-2465.8809, 2233.2749, 4.8305},
	{1701.0950, -1514.9611, 13.3433},
	{-314.3062, 2679.7949, 62.5505},
	{1712.6136, 1454.0483, 10.7662},
	{2223.4377, -1338.4004, 23.9100},
	{2822.0254, 910.9764, 10.7594},
	{-2076.6067, -2540.0500, 30.4246}
	},
	PlayerText:InfosTD,
	TruckerStep[MAX_PLAYERS],
	Float:CheckpointPos[MAX_PLAYERS][3],
	JobTime[MAX_PLAYERS],
	Step[MAX_PLAYERS],
	SecondsAFK[MAX_PLAYERS],
	Float:LastPos[MAX_PLAYERS][3],
	WarningsCheat[MAX_PLAYERS],
	VehicleOwned[MAX_VEHICLES],
	VehicleSQL[MAX_VEHICLES],
	Text:TD_CAPTURED[3],
	Dynamic_GangUP,
	Dynamic_GangDown,
	ChangeName[MAX_PLAYERS],
	ChangeNameEx,
	RPG,
	CPG,
	Gate[8],
	RobOn[ MAX_PLAYERS ],
	PropRobCP[ MAX_PROPS ],
	CNR_ZONE[ 2 ],
	bool:Cuffed[ MAX_PLAYERS ],
	CarsRobber[ 12 ],
	CarsCop[ 29 ],
	Cp[ 2 ],
	bPick[ 9 ],
	CnRgate[ 2 ],
	R_Timer[ MAX_PLAYERS ],
	ReloadTimmer[ MAX_PLAYERS ],
	PlayerText:CNR_TD[ 2 ],
	Float:PosCNR[MAX_PLAYERS][4],
	PlayerText:rInfoTDS[ MAX_PLAYERS ],
	ReportStr[2048],
	Text:ReportInfo,
	reTimer[MAX_PLAYERS],
	PlayerInGWar[4],
	GWarLocation,
	GangToWar,
	PlayerText:Ann,
	PlayerText:Targets1,
	PlayerText:Targets2,
	AntiSpamEx[MAX_PLAYERS],
	RandomWeaponTimer[MAX_PLAYERS],
	DuelPlayerInvite,
	DuelInviter,
	StrH[128],
	DuelCount = 3,
    DuelCountText[3][5] =
{
   "~w~1",
   "~r~2",
   "~w~3"
}
;
/*
Gang War Variables
*/
new GWAR1[5],
	GWAR2[5];
	//PLAYER1,
	//PLAYER2;
//
new CountText[ 5 ][ 5 ] =
{
	   "~p~1",
	   "~r~2",
	   "~g~3",
	   "~y~4",
	   "~b~5"
};
#define MAX_FIREWORK 100
#define NON -1
enum EnumFirework
{
	FW_Owner,
	Float:FW_Pos[4],
	Float:FW_Height,
	Float:FW_Radius,
	FW_Amount,
	FW_RocketsReleased,
	FW_RocketDirection,
	FW_Timer,
	FW_Box
};


#define MAX_SLOTS           100

#define MAX_SNOW_OBJECTS    8
#define UPDATE_INTERVAL     750


new bool:snowOn[MAX_SLOTS char],
	snowObject[MAX_SLOTS][MAX_SNOW_OBJECTS],
	updateTimer[MAX_SLOTS char]
;
#define ploop(%0)			for(new %0 = 0; %0 < MAX_SLOTS; %0++) if(IsPlayerConnected(%0))
new Text:TD_TICKS, Text:TD_FPS;
new Text:HClock;
new Text:HClock2;
new Text:HClock3;
new XDeaths[MAX_PLAYERS];
new LastDeath[MAX_PLAYERS]; // HackDetected[MAX_PLAYERS],
new timerban[MAX_PLAYERS], Float: Aimx[MAX_PLAYERS],Float: Aimy[MAX_PLAYERS],Float: Aimz[MAX_PLAYERS];
new BanName[MAX_PLAYER_NAME];
new FireworkInfo[MAX_FIREWORK][EnumFirework];
new mTime[MAX_PLAYERS][2];
new TheBomb[ MAX_PLAYERS ];
new Float:bx[ MAX_PLAYERS ], Float:by[ MAX_PLAYERS ], Float:bz[ MAX_PLAYERS ];
new ExplosionRadius = 15;
new Text3D:housei[MAX_HOUSES], HousePickup[MAX_HOUSES],	Text3D:Prop3D[MAX_PROPS], PropPickUP[MAX_PROPS], Float:housex, Float:housey, Float:housez;
new Text3D:Gang3D[MAX_GANGS], GangPickUP[MAX_GANGS];
#define Driver 0
#define Passanger 2
#pragma tabsize 0
//----------------------------------------------------------------------------//
#define White               0xFFFFFFFF
//----------------------------------------------------------------------------//
#define SCM         		SendClientMessage
//----------------------------------------------------------------------------//
new Act[MAX_PLAYERS];
new InCar[MAX_PLAYERS];
new WhatCar[MAX_PLAYERS];
//------------------------------------------------------------------------------
new AttachmentBones[ ][ 24 ] =
{
	{"{ffa500}Spine"},
	{"{00ff00}Head"},
	{"{1589ff}Left upper arm"},
	{"{ff0000}Right upper arm"},
	{"{ff00ff}Left hand"},
	{"{00ffff}Right hand"},
	{"{ffff00}Left thigh"},
	{"{A52A2A}Right thigh"},
	{"{008000}Left foot"},
	{"{FDD017}Right foot"},
	{"{F660AB}Right calf"},
	{"{c0c0c0}Left calf"},
	{"{F76541}Left forearm"},
	{"{8E35EF}Right forearm"},
	{"{808080}Left clavicle"},
	{"{ADD8E6}Right clavicle"},
	{"{0000ff}Neck"},
	{"{808000}Jaw"}
};
//------------------------------------------------------------------------------
new Iterator:PlayerInDerby<MAX_PLAYERS>,
	Iterator:PlayerInCNR<MAX_PLAYERS>;
new Float:DerbyCars[15][4] =
{
	{-1362.9799,932.8219,1036.0580,9.0890}, 	// 0
	{-1346.4526,935.4996,1036.0889,13.6811}, 	// 1
	{-1335.6995,938.2600,1036.1177,16.8043}, 	// 2
	{-1320.8756,944.9904,1036.2062,27.0307}, 	// 3
	{-1306.8385,953.5919,1036.3212,37.8366}, 	// 4
	{-1353.9670,934.0486,1036.2421,11.5836}, 	// 5
	{-1328.6377,941.0197,1036.3208,18.9670}, 	// 6
	{-1313.9012,948.6513,1036.4198,29.5596}, 	// 7
	{-1501.0956,960.3203,1036.9474,313.0457},	// 8
	{-1506.8105,968.1082,1037.0840,304.3027}, 	// 9
	{-1513.0317,976.8713,1037.2457,301.9500}, 	// 10
	{-1516.0858,988.2343,1037.4362,274.5044}, 	// 11
	{-1517.6569,995.6628,1037.5626,272.2782}, 	// 12
	{-1515.1127,1004.8807,1037.6969,262.3869}, 	// 13
	{-1510.7020,1014.6202,1037.8568,249.1825} 	// 14
};
new DerbyOn, DerbyPlaying, BloodringFull[15], Bloodring[15], DerbyCount;
#define DEFAULT_NUMBER_PLATE "{0072FF}E{FFFF00}S{FF0000}S"
#define VEHICLE_DEALERSHIP 1
#define VEHICLE_PLAYER 2
#define EX_SPLITLENGTH 113
#define EX_SPLITLENGTHH 128
#define MAX_CHARS_PER_LINE 128
#define FINAL_DOTS
new Planted[MAX_PLAYERS];
new gTime[MAX_PLAYERS][2];
new GInvite[MAX_PLAYERS];
new UseGTank[MAX_PLAYERS];
new UseGMinigun[MAX_PLAYERS];
new cpTeritory[500] = {0,...};
new shotTime[MAX_PLAYERS];
new shot[MAX_PLAYERS];
new SelectName[MAX_PLAYER_NAME];
new FRod			[ MAX_PLAYERS ],
	Fishing			[ MAX_PLAYERS ],
	Bait			[ MAX_PLAYERS ],
	FLine			[ MAX_PLAYERS ],
	RodObject,
	FishMarketIcon,
	FishingPickUP[10],
	antispam		[ MAX_PLAYERS ],
	hit				[ MAX_PLAYERS ],
	hiter			[ MAX_PLAYERS ];
//------------------------------------------------------------------------------
new PlayerText:GangWar[5];
new PlayerText:KSpree[4];
//------------------------------------------------------------------------------
new
	VCObj[MAX_PLAYERS][9],
    vTankTimer[MAX_PLAYERS],
    MgTime[MAX_PLAYERS],
    FwTimer[MAX_PLAYERS],
 	PickUpTimer[MAX_PLAYERS],
    RocketTime[MAX_PLAYERS],
    SpecialObject[MAX_PLAYERS][12]
;
new PlayerText:NRG[2];
new PlayerText:Car_Textdraw[8];
new PlayerText:PONT[3];
new False = false;
new VupTime[MAX_PLAYERS];
new Text:Logo[5], Text:TeleTD, LastManFirst[MAX_PLAYERS], LastMan = 0, LastManStarted = 0, LastManWeapon, LastManCount = 0;
new vNames[212][] =
{
	"Landstalker","Bravura","Buffalo","Linerunner","Perennial","Sentinel","Dumper","Firetruck","Trashmaster","Stretch",
	"Manana","Infernus","Voodoo","Pony","Mule","Cheetah","Ambulance","Leviathan","Moonbeam","Esperanto","Taxi",
	"Washington","Bobcat","Mr Whoopee","BF Injection","Hunter","Premier","Enforcer","Securicar","Banshee","Predator",
	"Bus","Rhino","Barracks","Hotknife","Trailer","Previon","Coach","Cabbie","Stallion","Rumpo","RC Bandit", "Romero",
	"Packer","Monster","Admiral","Squalo","Seasparrow","Pizzaboy","Tram","Trailer","Turismo","Speeder","Reefer","Tropic","Flatbed",
	"Yankee","Caddy","Solair","Berkley's RC Van","Skimmer","PCJ-600","Faggio","Freeway","RC Baron","RC Raider",
	"Glendale","Oceanic","Sanchez","Sparrow","Patriot","Quad","Coastguard","Dinghy","Hermes","Sabre","Rustler",
	"ZR-350","Walton","Regina","Comet","BMX","Burrito","Camper","Marquis","Baggage","Dozer","Maverick","News Chopper",
	"Rancher","FBI Rancher","Virgo","Greenwood","Jetmax","Hotring Racer","Sandking","Blista Compact","Police Maverick",
	"Boxville","Benson","Mesa","RC Goblin","Hotring Racer A","Hotring Racer B","Bloodring Banger","Rancher","Super GT",
	"Elegant","Journey","Bike","Mountain Bike","Beagle","Cropduster","Stuntplane","Tanker","Road Train","Nebula","Majestic",
	"Buccaneer","Shamal","Hydra","FCR-900","NRG-500","HPV-1000","Cement Truck","Tow Truck","Fortune","Cadrona","FBI Truck",
	"Willard","Forklift","Tractor","Combine","Feltzer","Remington","Slamvan","Blade","Freight","Streak","Vortex","Vincent",
	"Bullet","Clover","Sadler","Firetruck","Hustler","Intruder","Primo","Cargobob","Tampa","Sunrise","Merit","Utility",
	"Nevada","Yosemite","Windsor","Monster A","Monster B","Uranus","Jester","Sultan","Stratum","Elegy","Raindance","RC Tiger",
	"Flash","Tahoma","Savanna","Bandito","Freight","Trailer","Kart","Mower","Duneride","Sweeper","Broadway",
	"Tornado","AT-400","DFT-30","Huntley","Stafford","BF-400","Newsvan","Tug","Trailer","Emperor","Wayfarer",
	"Euros","Hotdog","Club","Trailer","Trailer","Andromada","Dodo","RCCam","Launch","Police Car (LSPD)","Police Car (SFPD)",
	"Police Car (LVPD)","Police Ranger","Picador","S.W.A.T. Van","Alpha","Phoenix","Glendale","Sadler","Luggage Trailer A",
	"Luggage Trailer B","Stair Trailer","Boxville","Farm Plow","Utility Trailer"
};
//------------------------------------------------------------------------------
#define AA_SPAWN             403.9481,2439.3096,16.9010
#define LVAIR_SPAWN          1316.8308,1292.5590,10.9600
#define LSAIR_SPAWN          1718.1328,-2670.0688,13.6496
#define BEACH_SPAWN          -2600.9280,1440.4557,7.3958
#define DRIFT_SPAWN          -299.5961,1562.3619,75.3594
#define ESS_SPAWN            -1186.1508,26.0317,14.1703
//------------------------------------------------------------------------------
//Hold System
//------------------------------------------------------------------------------
#define MAX_VEHICLE_ATTACHED_OBJECTS                    (8)
#define MAX_PLAYER_ATTACHED_OBJECTS                     10
#define SetPlayerHoldingObject(%1,%2,%3,%4,%5,%6,%7,%8,%9) SetPlayerAttachedObject(%1,MAX_PLAYER_ATTACHED_OBJECTS-1,%2,%3,%4,%5,%6,%7,%8,%9)
#define StopPlayerHoldingObject(%1) RemovePlayerAttachedObject(%1,MAX_PLAYER_ATTACHED_OBJECTS-1)
#define IsPlayerHoldingObject(%1) IsPlayerAttachedObjectSlotUsed(%1,MAX_PLAYER_ATTACHED_OBJECTS-1)
//------------------------------------------------------------------------------
#define Loop(%0,%1)    for(new %0 = 0; %0 != %1; %0++)
#define 												 IsOdd(%1) 	((%1) & 1)
#define ConvertTime(%0,%1,%2,%3,%4) \
 	new\
	    Float: %0 = floatdiv(%1, 60000) \
	;\
	%2 = floatround(%0, floatround_tozero); \
	%3 = floatround(floatmul(%0 - %2, 60), floatround_tozero); \
	%4 = floatround(floatmul(floatmul(%0 - %2, 60) - %3, 1000), floatround_tozero)
new AntiFlood[MAX_PLAYERS][5];
//------------------------------------------------------------------------------
new Float:gRandomSpawnMRF[5][3] =
{
	{18.1665,1524.3069,12.7700},
	{8.0770,1495.9248,12.7700},
	{41.6561,1498.5415,12.7700},
	{-22.8055,1556.4514,12.7700},
	{-22.5479,1494.9934,12.7700}
};
enum DMData
{
	MG, DE, OS, M4DM, AsztechDM, JDM, CSI, CSDD, ShellDM, SDM, MRF, PRODM, HUNGER, SD, ROCKET, Gwar
}
new DMInfo[MAX_PLAYERS][DMData];
enum ServerData
{
	//--------------------------------------------------------------------------
	PropertyPayDay, MinigunDM,    DeagleDM, 		AsztechDM, OSDM,       M4DM,  JDM,           CSIDM,
	CSDDM, 		    IslandDM,     CoruptDM,  		SniperDM,  Lift[4],    HBuy,  HSell,         HInt,
	CreatingHouse,	HPos[4],      CreatingProperty, PBuy,      PSell,      PInt,  Float:PPos[4], PName[24],
	PIncome,        CreatingPCar, cID,              vColor[3], vOwner[24], Count, ReacStarted,   MRF,
	HNSStartedEx,   HNSStarted,   HNSCount,		    HNSSeeker, PrizeID,	          PrizeAmount,   StarEventStarted,
 	StarID,         SPrizeID,     Question[129],    QReward[129],                 QStarted,      QAnswer[129],
    WhoSayFirst[129],             WStarted,         WReward[129],                 MathTest,      WhoMakeMostKillsStarted,
	WhoMakeMostKillsAdmin, WhoMakeMostKillsType, StarEventAdmin, TargetPlayers,   TargetObject,  ReactionTest,
    WhoMakesMostKillsAmmount[9],  WAdmin,           QAdmin,      ServerReports,   QTimer
}
//------------------------------------------------------------------------------
// Player Data
//------------------------------------------------------------------------------
enum PlayerData
{
	//--------------------------------------------------------------------------
	// Player Variables
	//--------------------------------------------------------------------------
	ID[4],			   Language,		  LoggedIn,			Vehicle,			MovieMan,
	Level,		       VIP,			      IsVipFree,		TDs[3],				FirstConnect,
	FLogin[3],  	   SPassword[42],     Read[3],          Description1[150],  Description2[150],
	Description3[150], EMail[50],         FirstSpawn,       BuyerID,            SellerID,
	ATrade,            Money,             Score,            Coins,              Kills,
	Deaths,            KillingSpree,      Respect[3],       C4,                 StuntPoints,
	DriftPoints,       RacePoints,        AntiSpam[3],      vChat,              Hide,
	RPreference,       Car,               Float:sPosX[5],   Float:sPosY[4],     Float:sPosZ[4],
	Invite[3],         Inviter[3],        Ignore[7],        Jailed,             BRB,
	Online[6],         VIPTime,	      	  Warns,            pKicks,             Muted[3],
	DoS,               Timer[7],          VipVehicle,       vBikeObj[9],        vHeliObj[8],
	vTankObj[8],       VControl[2],       GodMode[3],       InMG[7],            InDM,
	Variable,          Owner[3], 	      JobID[5],         Float:HousePos[4],  Float:PropPos[4],
	Income[4],         UpCost,            InCP,             AWarns,             VWarns,
	Float:FavPos[4],   VFW,           	  Speed[3],         VUP,		   	    Float:Boost,
	SLimit,            InStunt,           InRace,           InDrift,            Engine,
	Lights,            Alarm,             Doors,            Bonnet,             Boot,
	HTag[3],           AFoB,              MyCar,            JobStarted[6],      JobCP[3],
 	PMID,              InCarTDs,          DriftID,          DriftTime,			pWarns,
 	Zombie,            MuteTime,          Mute,     		MazeT, 				LastKicker,
 	MRFWeapon,         InMRF,             ReadPM,           VCar,				Gems,
 	gPoints,           gCaptures,         InZM, 		  	Float:Pos[4],       SpecType,
 	SpecID, 		   MuteTimer,		  DriftRank[35],  	RaceRank[35], 	    StuntRank[35],
	KillerRank[25],	   Stunt,			  TVip,				BKSpree,   			UHolds,
	pCar,              Hidden,            pColor[20],       VBike,      		P_AntiFall,
	FreeVIP,    	   Gifts, 			  ActionID,         FireWorks,          Spec,
	PlayerInBloodring, Blacklist,         Property,         House,              InHouse,
	Support,           AccRcon,           GPS,              GPST,               Credits,
	ATotal,            ESSRank,           ESSClan,          p_HoldSaving,       p_VehicleHoldSaving,
	o_index,           TunedVehicle,      Use_Attach,       AdminSince,         VWeapons,
	FavSkin,           UseSkin,			  LastOn[11],       MaxBans,            Manager,
	pNRE,		   	   pNMessage2,	      pNMessage,	    pFirstAnswer,	    pNewbieEnabled,
	AdminSecurity[5],  SecurityCode,      JumpSize,		    LastFPS,			FPS,
	Chat,			   DuelWatching,      DuelReceived,		DuelInvited,		ActiveDuel,
	onDuel,			   HaveBomb,  		  Bomb,				BombPlanted,		RecentlyRobbed,
	FAccount,		   DriftCP[6],		  SDriftT,		    SpeedB,				Fav[11],
	InGWar,			   InviteInGWar,	  NewAcc,			VIPTrial,           Events,
	ReadPMS,           MuteWarnings,      eKills,           eDeaths,            DM_Event,
	pUsername[MAX_PLAYER_NAME],           InJob,            CarID[10],          CNRPoints,
 	Wanteds,           ReportedBy,        CarVCP,           CountCars,          Age,
 	InTargets,         TargetPoints,      TargetsKills,     MinigunKills,       M4Kills,
	RocketKills,       SniperKills,       MRFKills,         DEKills,    		PRODMKills,
	InMinigun,         InM4,              InRocket,         InSniper,           PReactions,
    InDE,              InPRODM,           PMaths,           DuelID, 			DuelWeapon,
	DuelMiza, 		   InDuel,            DuelLocation[5],  DuelWeapon1,        DuelWeapon2,
	Spawned,           MRFWeaponSelected,
	//--------------------------------------------------------------------------
	// Gang Variables
	//--------------------------------------------------------------------------
	GangID,			   g_Captures,		  g_Rank,           g_Kills,			g_Points,
	g_Deaths,		   g_Warns,			  g_Skin,			turfe,				turftime,
	InBlow,            InRepair,       	  BlowTime,		    RepairTime,         Capturing,
	g_Tank,            g_Time[6],         g_Total,			Alliance,           c_Members,
	c_TMembers,        g_Members,
	//--------------------------------------------------------------------------
	// Radio System
	//--------------------------------------------------------------------------
	Radio,			   Radio2,	  	      Radio3,			Radio4,				Radio5,
	Radio6,			   Radio7,			  Radio8,			Radio9,			    Radio10,
	Radio11,
	//--------------------------------------------------------------------------
	// Gang War
	//--------------------------------------------------------------------------
	g_War,			   g_Score,
	//--------------------------------------------------------------------------
	// Hold System
	//--------------------------------------------------------------------------
	Hold1,             Hold2,             Hold3,            Hold4,              Hold5,
	Hold6,             Hold7,             Hold8,            Hold9
}
//------------------------------------------------------------------------------
enum VehicleData
{
    bool:vehStatus,
    vehID,
    vehModel,
    Float:vehPos[4],
    vehColor[2],
    vehOwner[MAX_PLAYER_NAME],
    vehicleData,
    vehPlate[16],
    Premium,
    mod0,
    mod1,
    mod2,
    mod3,
    mod4,
    mod5,
    mod6,
    mod7,
    mod8,
    mod9,
    mod10,
    mod11,
    mod12,
    mod13,
    PaintJob
};
//------------------------------------------------------------------------------
enum TopPlayers
{
	TopByStunt, TopByDrift, TopByRace, TopByHours[6], TopByKills
}
//------------------------------------------------------------------------------
enum AdminData
{
	Bans, Warns, Kicks, Mutes, Jails, Explodes, ChatsCleared
}
//------------------------------------------------------------------------------
enum HouseData
{
    Name[24], Rent, Cost, CostM, HouseTime, Sell, Interior, Locked, Float:InteriorX, Float:InteriorY, Float:InteriorZ, Float:HX, Float:HY, Float:HZ, hID
}
//------------------------------------------------------------------------------
enum PropData
{
    PropName[24], Cost, CostM, PropTime, Earning, EarningM, Float:PropX, Float:PropY, Float:PropZ, PropOwner[24], PropMapIcon, pID
}
//------------------------------------------------------------------------------
enum ClanData
{
	ID, Name[24], Rank, Color, Skin[3], Weapon[7], Float:Pos[4], Invite, Kills, Deaths, Leader
}
//------------------------------------------------------------------------------
enum GangData
{
	GangName[30],   TotalMembers, 	GangKills, 		GangDeaths, 	GangColor[128],	Gate_Status,
	Float:GangX, 	Float:GangY,	Float:GangZ,    Float:GangA, 	Points,     	Captures,
	GangWeapon1,	GangWeapon2,	GangWeapon3,    GangWeapon4,	GangWeapon5, 	GangWeapon6,
	ID,             MaxMembers,  	GangSkin,       GangTank,       GangMinigun,	c_Deaths,
	g_Premium,		g_Ally,         Locked,         LockedTime,     CapturedBy[30], g_Money,
	g_Coins,        g_Gems,         g_GPoints,      Float:lPosX, 	Float:lPosY,	Float:lPosZ
}
//------------------------------------------------------------------------------
enum CpData
{
	Float:CpX, Float:CpY, Float:CpZ, Weapon, PickUP
}
//------------------------------------------------------------------------------
enum TersData
{
	Float:minx,	Float:miny,	Float:maxx,	Float:maxy,	owner, ID, bool:turfing, turfingby
}
//------------------------------------------------------------------------------
enum JobData
{
	JType, Float:JPos[3], JName[32], JPickUp, Text3D:JLabel, JVeh
}
//------------------------------------------------------------------------------
new GangInfo[MAX_GANGS][GangData],
	Teritories[MAX_GANGS][TersData],
	Top[MAX_PLAYERS][TopPlayers],
	ServerInfo[ServerData],
	Player[MAX_PLAYERS][PlayerData],
    StuntCheckPoint[MAX_PLAYERS][28],
 	Admin[MAX_PLAYERS][AdminData],
    Job[MAX_JOBS][JobData],
    Clan[MAX_PLAYERS][ClanData],
	CpInfo[MAX_GANGS][CpData],
	HouseInfo[MAX_HOUSES][HouseData],
	PropInfo[MAX_PROPS][PropData],
	StuntTime[MAX_PLAYERS][28],
	Vehicles[MAX_VEH][VehicleData],
	Str[2048],
	Str2[2048],
	SQL,
	SoccerBall,
	TDString[3][1024*3],
	VehicleNames[212][] =
	{
	{"Landstalker"},		{"Bravura"},		{"Buffalo"},		{"Linerunner"},
	{"Perrenial"},			{"Sentinel"},		{"Dumper"},			{"Firetruck"},
	{"Trashmaster"},		{"Stretch"},		{"Manana"},			{"Infernus"},
	{"Voodoo"},				{"Pony"},			{"Mule"},			{"Cheetah"},
	{"Ambulance"},			{"Leviathan"},		{"Moonbeam"},		{"Esperanto"},
	{"Taxi"},				{"Washington"},		{"Bobcat"},			{"Mr Whoopee"},
	{"BF Injection"},		{"Hunter"},			{"Premier"},		{"Enforcer"},
	{"Securicar"},			{"Banshee"},		{"Predator"},		{"Bus"},
	{"Rhino"},				{"Barracks"},		{"Hotknife"},		{"Trailer 1"},
	{"Previon"},			{"Coach"},			{"Cabbie"},			{"Stallion"},
	{"Rumpo"},				{"RC Bandit"},		{"Romero"},			{"Packer"},
	{"Monster"},			{"Admiral"},		{"Squalo"},			{"Seasparrow"},
	{"Pizzaboy"},			{"Tram"},			{"Trailer 2"},		{"Turismo"},
	{"Speeder"},			{"Reefer"},			{"Tropic"},			{"Flatbed"},
	{"Yankee"},				{"Caddy"},			{"Solair"},			{"Berkley's RC Van"},
	{"Skimmer"},			{"PCJ-600"},		{"Faggio"},			{"Freeway"},
	{"RC Baron"},			{"RC Raider"},		{"Glendale"},		{"Oceanic"},
	{"Sanchez"},			{"Sparrow"},		{"Patriot"},		{"Quad"},
	{"Coastguard"},			{"Dinghy"},			{"Hermes"},			{"Sabre"},
	{"Rustler"},			{"ZR-350"},			{"Walton"},			{"Regina"},
	{"Comet"},				{"BMX"},			{"Burrito"},		{"Camper"},
	{"Marquis"},			{"Baggage"},		{"Dozer"},			{"Maverick"},
	{"News Chopper"},		{"Rancher"},		{"FBI Rancher"},	{"Virgo"},
	{"Greenwood"},			{"Jetmax"},			{"Hotring"},		{"Sandking"},
	{"Blista Compact"},		{"Police Maverick"},{"Boxville"},		{"Benson"},
	{"Mesa"},				{"RC Goblin"},		{"Hotring Racer A"},{"Hotring Racer B"},
	{"Bloodring Banger"},	{"Rancher"},		{"Super GT"},		{"Elegant"},
	{"Journey"},			{"Bike"},			{"Mountain Bike"},	{"Beagle"},
	{"Cropdust"},			{"Stunt"},			{"Tanker"}, 		{"Roadtrain"},
	{"Nebula"},				{"Majestic"},		{"Buccaneer"},		{"Shamal"},
	{"Hydra"},				{"FCR-900"},		{"NRG-500"},		{"HPV1000"},
	{"Cement Truck"},		{"Tow Truck"},		{"Fortune"},		{"Cadrona"},
	{"FBI Truck"},			{"Willard"},		{"Forklift"},		{"Tractor"},
	{"Combine"},			{"Feltzer"},		{"Remington"},		{"Slamvan"},
	{"Blade"},				{"Freight"},		{"Streak"},			{"Vortex"},
	{"Vincent"},			{"Bullet"},			{"Clover"},			{"Sadler"},
	{"Firetruck LA"},		{"Hustler"},		{"Intruder"},		{"Primo"},
	{"Cargobob"},			{"Tampa"},			{"Sunrise"},		{"Merit"},
	{"Utility"},			{"Nevada"},			{"Yosemite"},		{"Windsor"},
	{"Monster A"},			{"Monster B"},		{"Uranus"},			{"Jester"},
	{"Sultan"},				{"Stratum"},		{"Elegy"},			{"Raindance"},
	{"RC Tiger"},			{"Flash"},			{"Tahoma"},			{"Savanna"},
	{"Bandito"},			{"Freight Flat"},	{"Streak Carriage"},{"Kart"},
	{"Mower"},				{"Duneride"},		{"Sweeper"},		{"Broadway"},
	{"Tornado"},			{"AT-400"},			{"DFT-30"},			{"Huntley"},
	{"Stafford"},			{"BF-400"},			{"Newsvan"},		{"Tug"},
	{"Trailer 3"},			{"Emperor"},		{"Wayfarer"},		{"Euros"},
	{"Hotdog"},				{"Club"},			{"Freight"},		{"Trailer 3"},
	{"Andromada"},			{"Dodo"},			{"RC Cam"},			{"Launch"},
	{"Police Car LSPD"},	{"Police Car SFPD"},{"Police Car LVPD"},{"Police Ranger"},
	{"Picador"},			{"S.W.A.T. Van"},	{"Alpha"},			{"Phoenix"},
	{"Glendale"},			{"Sadler"},			{"Luggage A"},		{"Luggage B"},
	{"Stair Trailer"},		{"Boxville"},		{"Farm Plow"},		{"Utility Trailer"}
}, uID;
//------------------------------------------------------------------------------
new StartedM, StartedR,	MathsResult,
	Characters[][] =
	{
	    "A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M",
		"N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y",
		"Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
		"m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x",
		"y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
	},
	Chars[17] = "";
//------------------------------------------------------------------------------
/*new RandomMSG[][] =
{
    "~y~~h~Do you like DM ?~n~~g~~h~/DM!",
    "~y~~h~You think you are a Racer ?~n~~g~~h~/Race!",
    "~y~~h~Wanna make stunt ?~n~~g~~h~/sstunts!",
    "~y~~h~Wanna win some good stuff ?~n~~g~~h~/Minigames!",
	"~y~~h~Create your own Clan!~n~~g~~h~/Clan"
};*/
//=============================== DeathMatches ===============================//
new Float:gRandomPlayerSpawnsBerlin[ 15 ][ 3 ] =
{
	{ 334.9745,593.6806,54.4643	},
	{ 369.5484,541.3005,55.5004	},
	{ 373.7751,371.7840,55.3895	},
	{ 376.2444,324.1273,55.5335	},
	{ 279.6987,334.9035,55.5300	},
	{ 229.1635,273.1050,57.1865	},
	{ 147.8821,447.0887,55.5129	},
	{ 267.7067,420.2050,61.2187	},
	{ 272.3513,392.2033,60.5114	},
	{ 275.8344,406.5503,55.4927	},
	{ 337.8085,430.1932,55.4523	},
	{ 209.8055,489.9784,55.4927	},
	{ 151.1521,450.4908,55.5129	},
	{ 302.4646,328.7988,55.6940	},
	{ 378.5666,449.3748,55.5728	}
};
new Float:gRandomPlayerSpawnsSecret[ 6 ][ 3 ] =
{
	{ -1297.1464,2488.2246,87.0744	},
	{ -1317.5150,2509.3679,87.0420	},
	{ -1334.1820,2525.0828,87.0469	},
	{ -1313.6273,2528.4666,87.6287	},
	{  -1307.2946,2554.1614,87.3802	},
	{ -1292.5896,2529.2122,90.3828	}
};
new Float:gRandomPlayerSpawnsCdm[ 8 ][ 3 ] =
{
	{ 2258.8506,1008.7658,79.5547 },
	{ 2186.7070,1044.0896,79.5547 },
	{ 2232.0237,1090.4673,44.3188 },
	{ 2280.4524,1068.7147,29.3750 },
	{ 2275.1233,1111.2090,71.7583 },
	{ 2260.2332,1098.2457,38.3471 },
	{ 2169.1892,1120.9777,23.3359 },
	{ 2210.4958,1077.3981,29.5770 }
};
new Float:gRandomPlayerSpawnSniper[ 5 ][ 3 ] =
{
	{-974.3197,1061.0334,1345.6761},
	{-1016.1569,1054.8470,1343.1714},
	{-1047.8755,1073.8723,1343.9434},
	{-1080.2831,1055.1276,1343.2130},
	{-1131.0923,1057.4836,1346.4156}
};
new Float:gRandomPlayerSpawnsWar[ 8 ][ 3 ] =
{
	{ 217.0676,1822.3063,6.4141	 },
	{ 250.1942,1870.1205,12.1657 },
	{ 245.6392,1859.5126,14.0840 },
	{ 221.2532,1856.6844,13.0561 },
	{ 158.5646,1862.2035,17.7892 },
	{ 212.0281,1897.8333,16.8889 },
	{ 364.4248,1937.8834,17.6406 },
	{ 287.5190,1992.1075,17.6406 }
};
new Float:gRandomPlayerSpawnsIs[ 4 ][ 3 ] =
{
	{ -166.2086,-1754.4027,28.9088 },
	{ -92.6995,-1738.1389,28.9088  },
	{ -68.1050,-1823.5784,28.9088  },
	{ -108.0516,-1854.1918,28.9088 }
};
new Float:gRandomPlayerSpawnsAK47[ 4 ][ 3 ] =
{
	{ -1132.0127,1041.8582,1345.7402	},
	{ -1084.6278,1045.1215,1343.7249	},
	{ -1030.7943,1077.4656,1343.1545	},
	{ -969.1278,1044.3873,1345.0594	}
};
new Float:gRandomPlayerSpawnsSpS[ 3 ][ 3 ] =
{
	{ -2020.1448,540.8632,79.1693 },
	{ -2024.1591,549.1183,95.3231 },
	{ -2122.8374,529.1282,79.1693 }
};
new Float:gRandomPlayerSpawnsWAR2[ 4 ][ 3 ] =
{
	{ -3957.0791,536.4235,11.2552 },
	{ -4020.8958,580.7361,11.7203 },
	{ -4037.7195,529.2366,4.4063  },
	{ -4017.4614,510.5165,2.8914  }
};
new Float:gRandomPlayerSpawnsChina[ 7 ][ 3 ] =
{
	{ -142.1808,-3921.3735,103.2652	},
	{ -83.1500,-3838.1824,108.4668	},
	{ -51.5548,-3749.3232,102.9265	},
	{ -1.5898,-3682.1248,102.9125	},
	{ -16.0090,-3704.1826,107.9693	},
	{ -111.9086,-3732.6072,122.8301	},
	{ -161.2550,-3661.9902,129.2795	}
};
new Float:gRandomPlayerSpawnsJaildm[ 9 ][ 3 ] =
{
	{ 2959.2646,-1491.5033,750.4123	},
	{ 2938.9717,-1495.5232,755.5604	},
	{ 2970.1047,-1462.9409,747.4971	},
	{ 2982.5178,-1437.6316,747.4971	},
	{ 2970.5566,-1431.7539,753.1765	},
	{ 2948.9099,-1434.1798,747.4971	},
	{ 2902.8945,-1429.6777,747.7171	},
	{ 2893.4705,-1451.6508,760.2501	},
	{ 2931.8003,-1460.9846,748.9103	}
};
new Float:gRandomPlayerSpawnsFunnydm[ 6 ][ 3 ] =
{
	{ 1493.4711,-59.2838,339.8196 },
	{ 1493.8685,-35.2643,339.8196 },
	{ 1470.9625,-36.3689,339.8196 },
	{ 1470.9299,-59.2561,341.3196 },
	{ 1482.2603,-47.8464,339.8196 },
	{ 1493.6888,-49.9630,339.8196 }
};
new Float:gRandomPlayerSpawnsCsi[ 10 ][ 3 ] =
{
	{ 713.2425,-2376.1338,106.9559 },
	{ 702.4496,-2398.0469,106.9446 },
	{ 682.5457,-2410.5789,107.1734 },
	{ 660.2089,-2401.7751,107.1578 },
	{ 667.4688,-2373.8147,107.1766 },
	{ 684.1484,-2356.3262,107.1787 },
	{ 682.7889,-2310.9436,112.2332 },
	{ 691.7122,-2332.4470,112.2622 },
	{ 713.9238,-2322.8489,112.1638 },
	{ 740.5018,-2327.5930,112.3639 }
};
new Float:gRandomPlayerSpawnsVulcan[ 5 ][ 3 ] =
{
	{ -3223.3196,-3276.7527,3.0657 },
	{ -3298.9722,-3262.9629,2.4823 },
	{ -3254.8635,-3212.4167,2.5247 },
	{ -3210.9478,-3177.2322,3.8683 },
	{ -3169.4070,-3195.6873,4.4302 }
};
new Float:gRandomPlayerSpawnsddz[ 4 ][ 3 ] =
{
	{ 1818.3713,-1537.2501,13.3688 },
	{ 1754.3547,-1557.5608,9.5227  },
	{ 1755.3195,-1586.2234,13.1190 },
	{ 1818.5463,-1542.4182,17.0469 }
};
new Float:gRandomPlayerSpawnsMedieval[ 7 ][ 3 ] =
{
	{ 1837.7959,-3056.9199,13.7513 },
	{ 1811.2136,-3046.2803,6.0341  },
	{ 1813.4523,-3030.2456,6.1077  },
	{ 1793.2850,-3019.1125,6.1505  },
	{ 1829.0889,-3006.3586,6.1077  },
	{ 1793.0079,-3041.0132,11.7831 },
	{ 1842.2419,-3046.6028,6.0971  }
};
new Float:gRandomPlayerSpawnsPirate[ 6 ][ 3 ] =
{
	{ 988.3366,3066.4387,7.5085	 },
	{ 987.0741,3109.9075,9.2038	 },
	{ 971.4116,3134.2073,11.7265 },
	{ 981.2383,3017.1184,5.8342	 },
	{ 951.9218,3015.4453,1.9552	 },
	{ 933.1215,3083.2837,5.7272	 }
};
new Float:gRandomPlayerSpawnsHDM[ 6 ][ 3 ] =
{
	{ 1958.3942,-789.0942,133.3707 },
	{ 1959.1342,-790.6710,137.6947 },
	{ 1993.4481,-804.3514,137.6817 },
	{ 1961.5714,-791.4203,143.2656 },
	{ 1992.7616,-803.2070,143.2669 },
	{ 1975.1887,-803.3500,147.4312 }
};
new Float:gRandomPlayerSpawnCrossF[ 11 ][ 3 ] =
{
	{ 1771.9797,2053.0430,95.5650 },
	{ 1771.9727,2076.9766,95.5650 },
	{ 1753.3257,2095.2966,92.6353 },
	{ 1715.2501,2103.4531,79.4869 },
	{ 1671.7802,2079.8569,95.5650 },
	{ 1670.8695,2053.3843,95.5650 },
	{ 1684.9587,2037.8196,92.3743 },
	{ 1655.3245,2064.3037,79.4869 },
	{ 1721.6737,2069.7490,79.4869 },
	{ 1747.8751,2070.8889,85.0621 },
	{ 1787.4714,2066.1628,79.4869 }
};
new Float:gRandomPlayerSpawnLCDM[ 13 ][ 3 ] =
{
	{ 768.2528,892.6876,53.0200 },
	{ 769.0872,949.0131,55.7173 },
	{ 735.8961,987.1501,53.0300 },
	{ 695.4639,969.2310,58.8643 },
	{ 677.7917,970.1017,57.8224 },
	{ 655.5238,986.6481,56.3431 },
	{ 687.2000,1001.6337,66.4975 },
	{ 659.8108,1032.3568,53.0699 },
	{ 682.5427,1026.1168,53.0300 },
	{ 601.1516,965.2477,53.0300 },
	{ 545.0518,981.2041,53.0850 },
	{ 501.2912,894.2111,53.0200 },
	{ 539.0149,905.3505,53.0200 }
};
new Float:gRandomPlayerSpawnRocketIsland[ 8 ][ 3 ] =
{
	{ 832.6073,-3103.4463,15.9176 },
	{ 799.7595,-3146.9934,4.9574 },
	{ 757.0427,-3137.3982,14.0613 },
	{ 717.3144,-3106.1707,12.7996 },
	{ 697.9355,-3083.7322,15.6204 },
	{ 685.7570,-3021.3674,9.4991 },
	{ 722.6437,-2984.9553,6.2665 },
	{ 757.7574,-3016.0427,32.2655 }
};
new Float:gRandomPlayerSpawnRocketIsland2[ 5 ][ 3 ] =
{
	{ 1320.7490,-3945.9565,35.7381 },
	{ 1425.0082,-3943.5168,35.7381 },
	{ 1428.6802,-4054.9075,35.7381 },
	{ 1326.0067,-4053.9143,35.7381 },
	{ 1359.7678,-4008.8572,19.9000 }
};
new Float:gRandomPlayerSpawnKDM[ 2 ][ 3 ] =
{
	{ 1572.2537,-1244.5490,278.6250 },
	{ 1585.4230,-1233.4449,278.6250 }
};
new Float:gRandomPlayerSpawnTDM[ 10 ][ 3 ] =
{
	{ -2605.5789,3135.4299,16.1882 },
	{ -2587.3508,3128.8621,28.1084 },
	{ -2589.8901,3143.9363,35.3662 },
	{ -2573.5688,3153.5857,42.5564 },
	{ -2554.8357,3138.3179,30.7386 },
	{ -2640.3723,3142.1653,25.6987 },
	{ -2665.9077,3146.4321,20.2448 },
	{ -2683.9580,3138.6755,8.6118 },
	{ -2712.9727,3142.7354,5.7022 },
	{ -2719.0388,3132.2861,3.9644 }
};
new Float:CS_Inferno[ 10 ][ 3 ] =
{
	{ 9562.4736,-8742.4473,24.7969 },
	{ 9523.2725,-8742.9268,26.7892 },
	{ 9520.5107,-8795.3877,32.7106 },
	{ 9564.4121,-8795.9521,24.8020 },
	{ 9550.1416,-8824.2402,27.4098 },
	{ 9532.8984,-8834.6318,29.3881 },
	{ 9502.9443,-8837.4131,31.0907 },
	{ 9513.6299,-8822.2549,28.5977 },
	{ 9573.7188,-8746.7402,23.6398 },
	{ 9483.2139,-8800.3398,30.1891 }
};
new Float:CS_Assault[ 10 ][ 3 ] =
{
	{ 8140.6680,-7514.9404,51.6354 },
	{ 8108.5205,-7585.2905,38.7963 },
	{ 8165.0107,-7576.0938,26.5810 },
	{ 8136.5161,-7551.6880,15.3666 },
	{ 8114.1865,-7537.0381,15.3666 },
	{ 8081.9219,-7536.2124,15.3666 },
	{ 8120.4204,-7527.8076,21.2786 },
	{ 8149.9800,-7557.3008,15.3666 },
	{ 8163.3037,-7524.6299,15.3666 },
	{ 8073.4985,-7581.1655,15.3666 }
};
new Float:CS_De_Train[ 13 ][ 3 ] =
{
	{ -4281.5669,-6775.4883,16.0786 },
	{ -4301.8457,-6766.8618,19.3737 },
	{ -4302.5254,-6749.2026,16.0786 },
	{ -4341.9893,-6771.3755,16.1485 },
	{ -4370.3457,-6754.2568,17.5719 },
	{ -4401.5581,-6766.1685,16.9848 },
	{ -4388.4561,-6777.4355,20.1342 },
	{ -4449.0571,-6774.4956,17.1781 },
	{ -4432.5483,-6766.1592,16.1349 },
	{ -4277.6694,-6742.9438,16.0786 },
	{ -4214.1851,-6751.0361,16.0978 },
	{ -4185.5845,-6757.9082,16.2048 },
	{ -4168.7031,-6750.8223,16.0720 }
};
new Float:CS_De_Dust[ 14 ][ 3 ] =
{
	{ 7751.2578,-2667.4048,18.3846 },
	{ 7779.2744,-2672.8960,18.3833 },
	{ 7804.8428,-2671.7393,12.6534 },
	{ 7803.9258,-2615.0059,14.8611 },
	{ 7807.4341,-2568.7153,12.6534 },
	{ 7790.5703,-2587.1943,18.4535 },
	{ 7801.1069,-2600.6494,24.1006 },
	{ 7760.5244,-2611.5261,24.1293 },
	{ 7731.1230,-2601.0803,24.1052 },
	{ 7708.0791,-2588.8564,22.5658 },
	{ 7755.0991,-2572.5974,18.4135 },
	{ 7794.8667,-2553.9622,18.4069 },
	{ 7780.6763,-2642.3298,22.6015 },
	{ 7770.8901,-2620.0449,24.1283 }
};
new Float:CS_IceWorld[ 9 ][ 3 ] =
{
	{ 1514.0553,-8778.0225,9.9638 },
	{ 1514.4095,-8804.1084,9.9619 },
	{ 1525.3673,-8827.0361,9.9601 },
	{ 1540.5762,-8840.8906,9.9582 },
	{ 1549.5392,-8807.7480,9.9601 },
	{ 1578.0428,-8825.6807,9.9582 },
	{ 1585.9584,-8809.3867,9.9582 },
	{ 1579.1713,-8789.6309,9.9582 },
	{ 1571.3486,-8773.7041,9.9582 }
};
