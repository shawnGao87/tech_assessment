DROP TABLE IF EXISTS #temp, #temp2, #temp3, #temp4;

SELECT [Bus Number]
    , [Station]
    , CONVERT(DATETIME, [Time]) AS [Time]
INTO #temp
FROM [bus]

SELECT [Bus Number], [Station], [Time],

	DATEDIFF(minute, 
		CONVERT(DATETIME, LAG([Time]) OVER (PARTITION BY [Bus Number] ORDER BY [Time])),
		CONVERT(DATETIME, [Time])
	) AS [Time Diff],

	DATEDIFF(minute, 
			CONVERT(DATETIME, [Time]), 
			CONVERT(DATETIME,  LEAD([Time]) OVER (PARTITION BY [Bus Number] ORDER BY [Time]))
	) AS [Time To Next Station]
INTO #temp2
FROM #temp

SELECT [Bus Number],
	[Station],
	[Time],
	[Time To Next Station],
	[Time Diff],
	SUM([Time Diff]) OVER (PARTITION BY [Bus Number] ORDER BY [Time]) AS [Total Travel Time]
INTO #temp3
FROM #temp2

SELECT [Bus Number],
	[Station],

	CONVERT(varchar(5), 
			DATEADD( minute, 
					CONVERT(int, [Total Travel Time]),
					0),
			114
	) as [Total Travel Time],
	CONVERT(varchar(5), 
			DATEADD( minute, 
					CONVERT(int, [Time To Next Station]),
					0),
			114
	) AS [Time To Next Station]
INTO #temp4
FROM #temp3


SELECT [Bus Number],
	[Station],
	CASE WHEN [Total Travel Time] is null THEN '00:00'
			ELSE [Total Travel Time]
		END AS [Total Travel Time],
	CASE WHEN [Time To Next Station] is null THEN '00:00'
			ELSE [Time To Next Station]
		END AS [Time To Next Station]
FROM #temp4